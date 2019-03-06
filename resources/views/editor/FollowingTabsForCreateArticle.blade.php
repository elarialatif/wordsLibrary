<style>
    .glyphprogress {
        background: #fff;
        width: auto;
        color: #e0e0e0;
        display: block;
    }

    .glyphprogress ul {
        list-style: none;
        -webkit-margin-before: 0px;
        -webkit-margin-after: 0px;
        -webkit-margin-start: 0px;
        -webkit-margin-end: 0px;
        -webkit-padding-start: 0px;
        margin: 0;
    }

    .glyphprogress li {
        display: inline-block;
        width: 31%
    }

    .connecting-line {
        height: 2px;
        background: #e0e0e0;
        position: relative;
        width: 100%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 3rem;
        z-index: 1;
    }

    .glyphstep {
        width: 100px;
        height: 100px;
        line-height: 100px;
        display: inline-block;
        border-radius: 60px;
        background: #e0e0e0;
        color: black;
        border: 2px solid #e0e0e0;
        z-index: 2;
        position: relative;
        left: 0;
        text-align: center;
        font-size: 20px;
    }

    .glyphstep i {
    }

    .glyphcomplete {
        border: 2px solid lightgreen !important;
        color: lightgreen;
    }

    .glyphactive {
        border: 2px solid lightblue !important;
        color: lightblue;
    }
</style>

<div class="glyphprogress">
    <div class="connecting-line"></div>
    <ul>
        <a href="{{url('editor/add/article/'.$file_id.'/'.$level.'/'.'0'.'/'.'0')}}">
            <li>
            <span class="glyphstep" id="1">
                مقال مختصر
            </span>
            </li>
        </a>
        <a href="{{url('editor/add/article/'.$file_id.'/'.$level.'/'.'1'.'/'.'1')}}">
            <li>
            <span class="glyphstep" id="2">
                مقال موسع
            </span>
            </li>
        </a>
        <a href="{{url('editor/addVocabulary/'.$file_id.'/'.$level)}}">
        <li>
            <span class="glyphstep" id="3">
                معاني الكلمات
            </span>
        </li></a>
    </ul>
</div>