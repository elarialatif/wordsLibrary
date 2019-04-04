@extends('layouts.app')
@section('content')
    @php
        $instanceFromHomeController= new App\Http\Controllers\HomeController();
   $sharedArrayBetweenUsers= $instanceFromHomeController->usersDashboard();
    @endphp
    @php

        $editorsUser=array(
        \App\Helper\UsersTypes::EDITOR,
        \App\Helper\UsersTypes::Sound);

       $reviewersUsers=array(
        \App\Helper\UsersTypes::REVIEWER,

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

        @php
            $editorTasks= $instanceFromHomeController->editorWork();
        @endphp

        @include('dashboards.editorsDashboard')

    @elseif(in_array(auth()->user()->role,$reviewersUsers))

        @include('dashboards.reviewersDashboard')

    @elseif(in_array(auth()->user()->role,$listAndPlacementTestUsers))

        @include('dashboards.placementTestAndListsMakerDashboard')
    @endif
@endsection
