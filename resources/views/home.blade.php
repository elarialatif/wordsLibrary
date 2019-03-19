@extends('layouts.app')
@section('content')
    @php
        $editorsUser=array(
        \App\Helper\UsersTypes::EDITOR
        ,\App\Helper\UsersTypes::QuestionCreator,
        \App\Helper\UsersTypes::Sound);

       $reviewersUsers=array(
        \App\Helper\UsersTypes::REVIEWER,
        \App\Helper\UsersTypes::QuestionReviewer,
        \App\Helper\UsersTypes::Languestic,
       \App\Helper\UsersTypes::quality,
        \App\Helper\UsersTypes::LISTANALYZER,
       );

       $listAndPlacementTestUsers=array(
        \App\Helper\UsersTypes::LISTMAKER,
        \App\Helper\UsersTypes::PlacementTestEditor,
       );

    @endphp

    @if(in_array(auth()->user()->role,$editorsUser))

        @include('dashboards.editorsDashboard')

    @elseif(in_array(auth()->user()->role,$reviewersUsers))

        @include('dashboards.reviewersDashboard')

    @elseif(in_array(auth()->user()->role,$listUsers))

        @include('dashboards.analazerAndListsMakerDashboard')
    @endif

@endsection
