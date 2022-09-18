@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular games</h2>
        <div class="popular-games text-sm grid grid-cols-6 gap-12 border-b border-gray-800">
            <div class="game mt-8">
                <div class="relative inline-block">
                    <a href="#">
                        <img src="/ff7.jpg" alt="game cover">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
