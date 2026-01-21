<?php

if (! function_exists('ui_badge')) {

    function ui_badge(string $label, string $variant = 'gray'): string
    {
        $variants = [
            'success' => 'badge bg-success-500 text-white capitalize',
            'info'    => 'badge bg-info-500 text-white capitalize',
            'warning' => 'badge bg-warning-500 text-white capitalize',
            'danger'  => 'badge bg-danger-500 text-white capitalize',
            'gray'    => 'badge bg-slate-900 text-white capitalize',
        ];

        $class = $variants[$variant] ?? $variants['gray'];
        return "<span class='inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {$class}'>
        {$label}
    </span>";
    }
}

if (! function_exists('status_badge')) {

    function status_badge(string|int $status): string
    {
        // Normalize status
        $normalized = match (true) {
            $status === 1 || $status === '1' || $status === 'active'   => 'active',
            $status === 0 || $status === '0' || $status === 'inactive' => 'inactive',
            default => 'draft',
        };

        return ui_badge(
            ucfirst($normalized),
            match ($normalized) {
                'active'   => 'success',
                'inactive' => 'danger',
                'draft'    => 'gray',
                default    => 'info',
            }
        );
    }
}
