@extends('layouts.app')

@section('content')
<style>
  .timeline-item {
    position: relative;
    padding-left: 2rem;
    padding-bottom: 2rem;
  }
  .timeline-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #e5e7eb;
  }
  .timeline-item::after {
    content: '';
    position: absolute;
    left: -4px;
    top: 0;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #2563eb;
  }
  .timeline-item:last-child::before {
    height: 0;
  }
  .bullet-status {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
  }
  .bullet-status.green {
    background-color: #22c55e;
  }
  .bullet-status.yellow {
    background-color: #eab308;
  }
  .bullet-status.red {
    background-color: #ef4444;
  }
</style>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-2xl font-semibold text-gray-900">{{$dataLain->name ?? ''}}</h1>
        <p class="text-sm text-gray-500 mt-1">{{$dataLain->company_name ?? ''}}</p>
      </div>
      <a href="{{route('employee-safety-list')}}" class="text-gray-600 hover:text-gray-900">
        <i class="fas fa-arrow-left mr-2"></i>Back
      </a>
    </div>

    <!-- Timeline -->
    <div class="mt-8">
      <!-- Item 1 -->
@foreach ($dataHistory as $item)


      <div class="timeline-item">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex justify-between items-start">
            <div>
              <div class="flex items-center">
            <span class="bullet-status {{ $item->jenis_lampu }}"></span>

                <h3 class="text-lg font-medium text-gray-900">Safety Induction</h3>
              </div>

            </div>
            <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
                     @if($item->jenis_lampu === 'green')
  <span class="px-3 py-1 text-sm rounded-full text-green-800">Pelanggaran 1</span>
@elseif($item->jenis_lampu === 'yellow')
  <span class="px-3 py-1 text-sm rounded-full text-yellow-800">Pelanggaran 2</span>
@elseif($item->jenis_lampu === 'red')
  <span class="px-3 py-1 text-sm rounded-full text-red-800">Pelanggaran 3</span>

@endif

            </span>
          </div>
          <div class="mt-4">
            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-md">
             {{$item->note}}
            </p>
          </div>
          <div class="mt-4 flex items-center text-sm text-gray-500">
            <i class="far fa-calendar mr-2"></i> {{$item->date_terbit}}
            {{-- <span class="mx-2">•</span>
            <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">Training</span> --}}
          </div>
        </div>
      </div>
@endforeach
{{--
      <!-- Item 2 -->
      <div class="timeline-item">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex justify-between items-start">
            <div>
              <div class="flex items-center">
                <span class="bullet-status yellow"></span>
                <h3 class="text-lg font-medium text-gray-900">Safety Induction</h3>
              </div>
              <p class="text-sm text-gray-500 mt-1">Advanced Safety Training</p>
            </div>
            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">Issued 2</span>
          </div>
          <div class="mt-4">
            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-md">
              Advanced safety protocols and procedures training
            </p>
          </div>
          <div class="mt-4 flex items-center text-sm text-gray-500">
            <i class="far fa-calendar mr-2"></i> March 10, 2024
            <span class="mx-2">•</span>
            <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">Training</span>
          </div>
        </div>
      </div>

      <!-- Item 3 -->
      <div class="timeline-item">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex justify-between items-start">
            <div>
              <div class="flex items-center">
                <span class="bullet-status red"></span>
                <h3 class="text-lg font-medium text-gray-900">Safety Induction</h3>
              </div>
              <p class="text-sm text-gray-500 mt-1">Specialized Safety Training</p>
            </div>
            <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">Issued 3</span>
          </div>
          <div class="mt-4">
            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-md">
              Specialized equipment and hazardous materials handling training
            </p>
          </div>
          <div class="mt-4 flex items-center text-sm text-gray-500">
            <i class="far fa-calendar mr-2"></i> March 5, 2024
            <span class="mx-2">•</span>
            <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">Training</span>
          </div>
        </div>
      </div>

      <!-- Item 4 -->
      <div class="timeline-item">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
          <div class="flex justify-between items-start">
            <div>
              <div class="flex items-center">
                <span class="bullet-status green"></span>
                <h3 class="text-lg font-medium text-gray-900">Employment</h3>
              </div>
              <p class="text-sm text-gray-500 mt-1">Joined Digital Hyperspace Indonesia</p>
            </div>
            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">Started</span>
          </div>
          <div class="mt-4">
            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-md">
              Initial employment and onboarding process completed
            </p>
          </div>
          <div class="mt-4 flex items-center text-sm text-gray-500">
            <i class="far fa-calendar mr-2"></i> March 1, 2024
            <span class="mx-2">•</span>
            <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">Employment</span>
          </div>
        </div>
      </div> --}}

    </div>
  </div>
</main>
@endsection
