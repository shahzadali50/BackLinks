@extends('layouts.app')
@section('title')
Project | {{ auth()->user()->role }}
@endsection
@section('css')
<style>
    .projectViewCard i{
        font-size: 25px;
    }
</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Project
@endslot
@slot('title')
Project Detail
@endslot
@endcomponent

<div class="row mt-4">

    @php
    // Decode categories
    $categories = json_decode($project->categories, true);
    $categoriesList = is_array($categories) ? implode(', ', $categories) : $categories;
    // Decode countries
    $countries = json_decode($project->countries);
    $countriesList = is_array($countries) ? implode(', ', $countries) : $countries;
    // Decode objectives
    $objectives = json_decode($project->objectives);
    $objectivesList = is_array($objectives) ? implode(', ', $objectives) : $objectives;
    // Decode languages
    $languages = json_decode($project->languages, true);
    // Convert array to comma-separated list, or just display the value if not an array
    $languagesTopicsList = is_array($languages) ? implode(', ', $languages) : $languages;
    // Decode trackkeywords
    $trackkeywords = json_decode($project->trackkeywords, true);
    // Convert array to comma-separated list, or just display the value if not an array
    $trackkeywordsList = is_array($trackkeywords) ? implode(', ', $trackkeywords) : $trackkeywords;
    $competitors = json_decode($project->competitors, true);

    @endphp
    <div class="col-12">
        <div class="card border btn-soft-success projectViewCard ">
            <div class="card-header web-card-header">
                <p data-bs-toggle="tooltip" data-bs-placement="top" title="Project name" style="font-weight: 700" class="card-title mb-0 text-dark">{{ $project->name }}</p>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex ">
                            <p data-bs-toggle="tooltip" data-bs-placement="top" title="Languages">
                                <i style="font-size: 17px;" class="fa fa-language me-1 text-info"
                                    aria-hidden="true "></i>
                                     {{ $languagesTopicsList }}
                                    </p>

                        </div>
                        <div class="">
                            <div>
                                <p  data-bs-toggle="tooltip" data-bs-placement="top" title="Categories"><i style="font-size: 17px;" class="bx bx-category-alt text-success me-1"
                                        aria-hidden="true "></i>
                                    {{ $categoriesList }}
                                </p>
                            </div>

                        </div>

                        <p data-bs-toggle="tooltip" data-bs-placement="top" title="keywords" class="mb-1"><i style="color: rgb(87, 85, 0)" class="bx bx-dialpad me-1"

                                aria-hidden="true"></i>
                            <span
                                class="badge bg-primary-subtle text-primary badge-border">{{ $project->keywords }}</span>
                        </p>

                        <p   data-bs-toggle="tooltip" data-bs-placement="top" title="Trackkeywords" class="mb-1"><i class="bx bx-universal-access text-warning me-1 " aria-hidden="true"></i>
                            {{ $trackkeywordsList }}

                        </p>


                        <p data-bs-toggle="tooltip" data-bs-placement="top" title="Device" class="mb-1"><i style="color: rgb(122, 95, 7)" class="bx bxs-devices me-1"
                                aria-hidden="true"></i>
                                <span class="badge bg-warning-subtle text-warning badge-border">

                                    {{ $project->track_device }}
                                </span>

                        </p>

                    </div>
                    <div class="col-md-5">
                        <p data-bs-toggle="tooltip" data-bs-placement="top" title="Countries"><i class="fa fa-globe me-1" aria-hidden="true "></i>{{ $countriesList }}</p>

                        <p style="border-radius: 8px;" class="bg-dark-subtle px-2">
                        </p>

                        <p data-bs-toggle="tooltip" data-bs-placement="top" title="Objectives"><i class="bx bxs-objects-horizontal-left me-1 text-primary" aria-hidden="true"></i>

                            <span class="badge bg-info-subtle text-info badge-border">
                                {{ $objectivesList }}</span>

                        </p>
                        @if(is_array($competitors))
                        <p  data-bs-toggle="tooltip" data-bs-placement="top" title="competitor1" class="mb-1"><i class="bx bx-link me-1" aria-hidden="true"></i> Competitor 1: <a
                                href="{{ $competitors['competitor1'] }}"
                                target="_blank">{{ $competitors['competitor1'] }}</a></p>

                        <p data-bs-toggle="tooltip" data-bs-placement="top" title="competitor2" class="mb-1"><i class="bx bx-link me-1" aria-hidden="true"></i> Competitor 2: <a
                                href="{{ $competitors['competitor2'] }}"
                                target="_blank">{{ $competitors['competitor2'] }}</a></p>
                        <p data-bs-toggle="tooltip" data-bs-placement="top" title="competitor3" class="mb-1"><i class="bx bx-link me-1" aria-hidden="true"></i> Competitor 3: <a
                                href="{{ $competitors['competitor3'] }}"
                                target="_blank">{{ $competitors['competitor3'] }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
