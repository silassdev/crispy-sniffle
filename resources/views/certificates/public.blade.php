<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $cert->certificate_number }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="max-w-4xl w-full bg-white rounded-xl shadow-2xl overflow-hidden">
        <!-- Certificate Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-8 text-white text-center">
            <h1 class="text-3xl font-bold mb-2">{{ config('app.name') }}</h1>
            <p class="text-indigo-100">Certificate of Achievement</p>
        </div>

        <!-- Certificate Body -->
        <div class="p-12 text-center">
            <div class="mb-8">
                <div class="inline-block px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium mb-4">
                    {{ $cert->certificate_number }}
                </div>
            </div>

            <h2 class="text-xl text-gray-600 mb-4">This certificate is proudly presented to</h2>
            <h3 class="text-4xl font-bold text-gray-900 mb-6">{{ $cert->student->name }}</h3>
            
            <p class="text-lg text-gray-700 mb-8">
                For successfully completing the course:<br>
                <span class="font-semibold text-xl text-indigo-600 mt-2 block">{{ $cert->course->title ?? 'General Achievement' }}</span>
            </p>

            @if($cert->notes)
                <div class="max-w-2xl mx-auto mb-8">
                    <p class="text-gray-600 italic text-sm">{{ $cert->notes }}</p>
                </div>
            @endif

            <!-- Footer Info -->
            <div class="mt-12 pt-8 border-t border-gray-200 grid grid-cols-2 gap-8 text-sm text-gray-600">
                <div>
                    <p class="font-semibold text-gray-900">{{ $cert->trainer->name }}</p>
                    <p>Trainer</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">{{ $cert->issued_at ? $cert->issued_at->format('F d, Y') : '' }}</p>
                    <p>Date Issued</p>
                </div>
            </div>
        </div>

        <!-- Download Action -->
        <div class="bg-gray-50 px-8 py-6 text-center border-t border-gray-200">
            <a href="{{ route('certificates.pdf.download', $cert->id) }}" 
               class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Download PDF Certificate
            </a>
        </div>
    </div>
</body>
</html>
