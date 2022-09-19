@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="game-details border-b border-gray-800 pb-12 flex">
            <div class="flex-none">
                <img src="/ff7.jpg" alt="cover">
            </div>
            <div class="ml-12">
                <h2 class="font-semibold text-4xl">Final Fantasy 4 Remake</h2>
                <div class="text-gray-400">
                    <span>Adventure, RPG</span>
                    &middot;
                    <span>Square Enix</span>
                    &middot;
                    <span>Playstation 4</span>
                </div>

                <div class="flex flex-wrap items-center mt-8 space-x-12">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-700 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">90%</div>
                        </div>
                        <div class="ml-4 text-xs">Member <br> Score</div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-700 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">92%</div>
                        </div>
                        <div class="ml-4 text-xs">Critic <br> Score</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
