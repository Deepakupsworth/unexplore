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

    /**
     * GLOBAL STATUS BADGE
     *
     * Supports:
     * - active / inactive
     * - booking status
     * - payment status
     * - numeric (0/1)
     */
    function status_badge(string|int|null $status): string
    {
        if ($status === null) {
            return ui_badge('Unknown', 'gray');
        }

        $status = strtolower((string) $status);

        return match ($status) {

            /* ✅ ACTIVE / INACTIVE */
            '1', 'active', 'enabled'
            => ui_badge('Active', 'success'),

            '0', 'inactive', 'disabled'
            => ui_badge('Inactive', 'danger'),

            /* ✅ BOOKING STATUS */
            'pending'
            => ui_badge('Pending', 'warning'),

            'confirmed', 'completed'
            => ui_badge('Confirmed', 'success'),

            'cancelled'
            => ui_badge('Cancelled', 'danger'),

            /* ✅ PAYMENT STATUS */
            'paid'
            => ui_badge('Paid', 'success'),

            'unpaid'
            => ui_badge('Unpaid', 'warning'),

            'refunded'
            => ui_badge('Refunded', 'info'),

            'failed'
            => ui_badge('Failed', 'danger'),

            /* ✅ GENERIC */
            'draft'
            => ui_badge('Draft', 'gray'),

            default
            => ui_badge(ucfirst($status), 'gray'),
        };
    }
}
