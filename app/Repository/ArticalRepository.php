<?php

namespace App\Repository;

use App\ArticleCategory;
use App\Helper\ArticleLevels;
use App\Helper\Steps;
use App\Models\Article;
use App\Models\ArticleFiles;
use App\Models\Link;
use App\Models\ListCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ArticalRepository
{
    private $filename;

    public function analyze($id)
    {

        if (!is_numeric($id)) {
            $fileExtension = $id->getClientOriginalExtension();
            $filename = realpath($id);

        } else {
            $file = ArticleFiles::find($id);
            $list = ContentListsRepository::find($file->list_id);
            $fileExtension = $file->extension;
            $data['list'] = $list;
            $filename = storage_path() . '/' . 'files' . '/' . $file->fileName;
        }

        // $content = File::get($filename);
        if ($fileExtension == 'txt') {
            $fopen = fopen($filename, 'r');
            $fread = fread($fopen, filesize($filename));
            fclose($fopen);
        } elseif
        ($fileExtension == 'docx') {
            $this->filename = $filename;
            $fread = $this->read_docx();
        } elseif
        ($fileExtension == 'doc') {
            $this->filename = $filename;
            $fread = $this->read_doc();
        } else {
            return redirect()->back()->withErrors(['هذا النوع من الملفات غير مدعوم']);
        }

        $remove = "\n";
        $file = preg_replace('~[\n\r:.,"""\r\n]~', ' ', $fread);

        $stopword = array('/ أنا /', '/ نحن /', '/ هو /', '/ هي /', '/ هما /', '/ هم /', '/ هن /', '/ أنت /', '/ أنتما /', '/ أنتن /', '/ الذي /', '/ التي /', '/ اللذان /', '/ اللتان /', '/ الذين /', '/ اللائي /', '/ اللاتي /', '/ من /', '/ ما /', '/ هذا /', '/ هذه /', '/ هاتان /', '/ هؤلاء /', '/ ذلك /', '/ تلك /', '/ أولئك /', '/ من /', '/ عن /', '/ علي /', '/ في /', '/ إلى /', '/ ثم /', '/ أو /', '/ أم /', '/ لكن /', '/ لا /', '/ لم /', '/ لن /', '/ أن /', '/ كي /', '/ نعم /', '/ إن /');
        //$spical_char = array('أنا', 'نحن', 'هو', 'هي', 'هما', 'هم', 'هن', 'أنت', 'أنتما', 'أنتن', 'هذا', 'هذه', 'هذان', 'هاتان', 'هؤلاء', 'ذلك', 'تلك', 'أولئك', 'الذي', 'التي', 'اللذان', 'اللتان', 'الذين', 'اللائي', 'اللاتي', 'من', 'ما', 'من', 'عن', 'على', 'في', 'إلى', 'ثم', 'أو', 'أم', 'لكن', 'لا', 'لم', 'لن', 'لان', 'لن', 'كي', 'نعم');
        $test = array('/ها /');
        $fileTextContent = preg_replace('/[^أ-ي-ء-آ]/ui', '', $file);

        $file2 = preg_replace('/[^أ-ي-ء-آ-0-1-2-3-4-5-6-7-8-9-٠-١-٢-٣-٤-٥-٦-٧-٨-٩ ]/ui', '', $file);

        //$file2 = (preg_replace($test, ' ', $file2));
        $file3 = (preg_replace($stopword, ' ', $file2));
        //dd($file2);
        $split = explode(' ', $file3);
        //$split = str_replace($spical_char, '', $split);
        $Array = array_filter($split, function ($value) {
            return $value !== '';
        });
        $orginalFile = explode(' ', $file2);

        //$type = $request->type;
        //dd($Array);

        $finalArray = array_count_values($Array);
        //dd($finalArray);
        //arsort($finalArray);
        if (count($finalArray) == 0) {
            return false;
        }
        $data['file'] = $file;
        $data['finalArray'] = $finalArray;
        $data['Array'] = $Array;
        $data['orginalFile'] = $orginalFile;
        $data['fileTextContent'] = $fileTextContent;
        return $data;

    }

    static function save($request)
    {
        DB::transaction(function () use ($request) {
            if (count($request->link) > 0) {
                Link::where('list_id', $request->list_id)->delete();
//                dd($request);
                $linkData['link'] = $request->link;
                $linkData['name'] = $request->name;
                $linkData['list_id'] = $request->list_id;
                LinksRepository::save($linkData);
            }
            $filename2 = $request->file('filename');

            $filename2->move(storage_path() . '/' . 'files', $filename2->getClientOriginalName());
            $article = ArticleFiles::where('list_id', $request->list_id)->first();
            if ($request->image && $request->image != null) {
                $filename = $request->image->getClientOriginalName();
                $request->image->move(public_path() . '/' . 'listsImage', $filename);
            }
            if ($request->featureImage && $request->featureImage != null) {
                $img = $request->featureImage->getClientOriginalName();
                $request->featureImage->move(public_path() . '/' . 'FeatureImage', $img);
            }
            $NewArticle = new ArticleFiles();
            if ($article) {
                $NewArticle = $article;
                ContentListsRepository::updateStep($request->list_id, Steps::ANALYZING_FILE);
                //Notification/////
                NotificationRepository::notify($request->list_id, Steps::ANALYZING_FILE);
                ///end Notification////
            }

            $listData['image'] = 'listsImage/' . $filename;
            $listData['featureImage'] = 'FeatureImage/' . $img;
            $list = ContentListsRepository::find($request->list_id);
            if ($list->image != null) {
                unlink(public_path($list->image));
            }

            ContentListsRepository::update($request->list_id, $listData);
            $NewArticle->articleName = $request->articleName;
            $NewArticle->list_id = $request->list_id;
            $NewArticle->publish_details = $request->publish_details;
            $NewArticle->path = $filename2->path();

            $NewArticle->fileName = $filename2->getClientOriginalName();
            $NewArticle->extension = $filename2->getClientOriginalExtension();
            $NewArticle->editor = $request->editor;
            $NewArticle->reference = $request->reference;
            $NewArticle->user_id = auth()->id();
            $NewArticle->save();
            ListCategory::where('list_id', $request->list_id)->delete();
            foreach (\request('cat_id_list') as $cat_id) {
                $data[] = array(
                    'cat_id' => $cat_id,
                    'list_id' => $request->list_id,
                );
            }
            ListCategory::insert($data);
        });
    }

    private function read_doc()
    {
        $fileHandle = fopen($this->filename, "r");
        $line = @fread($fileHandle, filesize($this->filename));
        $lines = explode(chr(0x0D), $line);
        $outtext = "";
        foreach ($lines as $thisline) {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE) || (strlen($thisline) == 0)) {
            } else {
                $outtext .= $thisline . " ";
            }
        }
        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);

        return $outtext;
    }

    private function read_docx()
    {

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip)) {
            return false;
        }

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) {
                continue;
            }

            if (zip_entry_name($zip_entry) != "word/document.xml") {
                continue;
            }

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        } // end while

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

    static function getArticleByLevel($list_id, $level)
    {
        $articleCheck = Article::where(['list_id' => $list_id, 'level' => $level])->first();
        if ($articleCheck) {
            return $articleCheck;
        }
        return false;
    }

    static function updateArticleStatusToReview($article_id)
    {
        $article = Article::find($article_id);
        $article->status = ArticleLevels::Review;
        $article->save();

    }

    static function getArticleById($id)
    {
        $article = Article::find($id);
        return $article;
    }
}

