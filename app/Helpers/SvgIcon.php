<?php
namespace App\Helpers;

class SvgIcon
{
    public static function render($name)
    {
        $icons = [
            'users' => '<svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M17 20v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/><circle cx=\"12\" cy=\"7\" r=\"4\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>',
            'shield-check' => '<svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M12 2l7 4v5c0 5-3.58 9-7 11-3.42-2-7-6-7-11V6l7-4z\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/><path d=\"M9 12l2 2 4-4\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>',
            'academic-cap' => '<svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M12 14l9-5-9-5-9 5 9 5z\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/><path d=\"M12 14v7\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>',
            'chat' => '<svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>',
            'document-text' => '<svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/><path d=\"M14 2v6h6\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>',
            'chat-bubble-left-right' => '<svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M7 8h10M7 12h4\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>',
            'view-grid' => '<svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><rect x=\"3\" y=\"3\" width=\"8\" height=\"8\" rx=\"1\" stroke-width=\"1.5\"/><rect x=\"13\" y=\"3\" width=\"8\" height=\"8\" rx=\"1\" stroke-width=\"1.5\"/><rect x=\"3\" y=\"13\" width=\"8\" height=\"8\" rx=\"1\" stroke-width=\"1.5\"/><rect x=\"13\" y=\"13\" width=\"8\" height=\"8\" rx=\"1\" stroke-width=\"1.5\"/></svg>',
        ];

        return $icons[$name] ?? $icons['view-grid'];
    }
}
