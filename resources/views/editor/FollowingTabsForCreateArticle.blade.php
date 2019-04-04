<style>
    .container .stepbar-progress {
        margin-bottom: 30px;
    }

    .stepbar-progress {
    }

    .stepbar-progress {
        width: 100%;
        height: 32px;
        border-collapse: collapse;
    }

    .stepbar-progress .step-item {
        width: 32px;
    }

    .stepbar-progress[data-current-step="1"][data-step-status="pending"] .step-item[data-step="1"] .step-body {
        background-color: #F8AC59;
    }

    .stepbar-progress .step-item .step-body {
        position: relative;
        display: block;
        width: 100px;
        height: 100px;
        background-color: #E4E4E7;
        border: 5px solid #E4E4E7;
        border-radius: 50%;
        text-align: center;
        margin: auto;
    }

    .stepbar-progress .step-item .step-body span {
        margin: 2rem 0;
        display: block;
        font-size: 16px;
        color: #000;
        font-family: bold;
    }

    .stepbar-progress .step-item-first .step-body:after, .stepbar-progress .step-item-middle .step-body:after {
        left: 100%;
    }

    .stepbar-progress .step-item-progress {
        width: 0%;
        height: 32px;
        verticle-align: middle;
    }

    .stepbar-progress .step-item-progress .progress-body {
        display: block;
        height: 11px;
        background-color: #E4E4E7;
        border-top: 3px solid #E4E4E7;
        border-bottom: 3px solid #E4E4E7;
        background-image: linear-gradient(-45deg, rgba(255, 255, 255, 0.3) 0%, transparent 5%, rgba(255, 255, 255, 0.3) 10%, transparent 15%, rgba(255, 255, 255, 0.3) 20%, transparent 25%, rgba(255, 255, 255, 0.3) 30%, transparent 35%, rgba(255, 255, 255, 0.3) 40%, transparent 45%, rgba(255, 255, 255, 0.3) 50%, transparent 55%, rgba(255, 255, 255, 0.3) 60%, transparent 65%, rgba(255, 255, 255, 0.3) 70%, transparent 75%, rgba(255, 255, 255, 0.3) 80%, transparent 85%, rgba(255, 255, 255, 0.3) 90%, transparent 95%, rgba(255, 255, 255, 0.3) 100%);
        transition: all 1s ease;
    }

    .stepbar-progress .step-item-progress .progress-body .body-fill {
        width: 20px;
        height: 5px;
        background-color: #1AB394;
    }

    .pending .step-body {
        background: #04a9f5 !important;
    }

    .done .step-body {
        background: green !important;
    }

    .pending .step-body span {
        color: #fff !important;
    }

    .done .step-body span {
        color: #fff !important;
    }

    .changeColor {
        background-color: green !important;
        border-top: 3px solid green !important;
        border-bottom: 3px solid green !important;
    }
</style>

<?php
$list_id=\App\Models\ArticleFiles::find($file_id)->list_id;
$step=\App\Models\ContentList::find($list_id)->step;
?>
<table class="stepbar-progress">
    <tbody>
    <tr>
        <td class="step-item step-item-first @if(request()->url()==url('editor/add/article/'.$file_id.'/'.$level.'/'.$page.'/'.'0') ||request()->url()==url('editor/add/article/'.$file_id.'/'.$level.'/'.$page) ) pending  @else done @endif"
            data-step="1">
            <a href="{{url('editor/add/article/'.$file_id.'/'.$level.'/'.$page.'/'.'0')}}">
                    <span class="step-body">
                        <span>
                                مقال مختصر
                        </span>
                    </span>
            </a>
        </td>
        <td class="step-item-progress  step-progress1">
                <span class="progress-body">
                    <span class="body-fill"></span>
                </span>
        </td>
        @if($step==\App\Helper\Steps::INSERTING_ARTICLE)
        <td class="step-item step-item-first @if(request()->url()==url('editor/create/'.$file_id.'/'.$level)) pending @elseif(request()->url()!=url('editor/add/article/'.$file_id.'/'.$level.'/'.$page.'/'.'0')) done @endif"
            data-step="1">
            <a href="{{url('editor/create/'.$file_id.'/'.$level)}}">
                    <span class="step-body">
                        <span>
                                نشاط مختصر
                        </span>
                    </span>
            </a>
        </td>
            <td class="step-item-progress step-progress2">
                <span class="progress-body">
                    <span class="body-fill"></span>
                </span>
            </td>
        @else

            <td class="step-item step-item-first @if(request()->url()==url('editor/show/'.$file_id.'/'.$level.'/'.$page)) pending  @elseif(request()->url()!=url('editor/add/article/'.$file_id.'/'.$level.'/'.$page.'/'.'0')) done @endif"
                data-step="1">
                <a href="{{url('editor/show/'.$file_id.'/'.$level.'/'.$page)}}">
                    <span class="step-body">
                        <span>
                            الأنشطة
                        </span>
                    </span>
                </a>
            </td>
            <td class="step-item-progress step-progress2">
                <span class="progress-body">
                    <span class="body-fill"></span>
                </span>
            </td>
        @endif
        <td class="step-item step-item-middle  @if(request()->url()==url('editor/add/article/'.$file_id.'/'.$level.'/'.$page.'/'.'1')) pending @elseif(request()            ->url()==url('editor/createAdditional/'.$file_id.'/'.$level) ||request()->url()==url('editor/addVocabulary/'.$file_id.'/'.$level.'/'.$page)) done @endif"
            data-step="2">
            <a href="{{url('editor/add/article/'.$file_id.'/'.$level.'/'.$page.'/'.'1')}}">
                    <span class="step-body">
                       <span> مقال موسع </span>
                    </span>
            </a>
        </td>
        <td class="step-item-progress step-progress3">
                <span class="progress-body">
                    <span class="body-fill"></span>
                </span>
        </td>
        @if($step==\App\Helper\Steps::INSERTING_ARTICLE)
        <td class="step-item step-item-first @if(request()->url()==url('editor/createAdditional/'.$file_id.'/'.$level)) pending  @elseif(request()->url()==url('editor/addVocabulary/'.$file_id.'/'.$level.'/'.$page)) done @endif"
            data-step="1">
            <a href="{{url('editor/createAdditional/'.$file_id.'/'.$level)}}">
                    <span class="step-body">
                        <span>
                                نشاط موسع
                        </span>
                    </span>
            </a>
        </td>
        <td class="step-item-progress step-item-third-nxt">
                <span class="progress-body">
                    <span class="body-fill"></span>
                </span>
        </td>
        @endif
        <td class="step-item step-item-last  @if(request()->url()==url('editor/addVocabulary/'.$file_id.'/'.$level.'/'.$page)) pending @endif"
            data-step="3">
            <a href="{{url('editor/addVocabulary/'.$file_id.'/'.$level.'/'.$page)}}">
                    <span class="step-body">
                      <span>  معاني الكلمات </span>
                    </span>
            </a>
        </td>
    </tr>
    </tbody>
</table>
<script>
    // $(document).ready(function () {
    //     if ($(".step-item-first").hasClass("done")) {
    //
    //         $('.step-item-middle-prev .progress-body').addClass('changeColor');
    //     }
    //     if ($(".step-item-middle").hasClass("done")) {
    //         $('.step-item-middle-nxt .progress-body').addClass('changeColor');
    //     }
    // });
</script>