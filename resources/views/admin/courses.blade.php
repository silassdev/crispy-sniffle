@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Courses Management') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center py-20">
                    <div class="mb-4">
                        <x-icons.courses class="w-16 h-16 mx-auto text-indigo-500 opacity-20" />
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700">Courses Management</h3>
                    <p class="text-gray-500 mt-2">This module is currently being developed. Check back soon!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
