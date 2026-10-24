<?php

namespace App\Support;

/**
 * Single source of truth for the 4 modules.
 * Used by the sidebar and the dashboard cards, so they never get out of sync.
 */
class Modules
{
    public static function all(): array
    {
        return [
            [
                'key' => 'items',
                'label' => 'Inventory Master Items',
                'pattern' => 'items.*',
                'icon' => 'box.png', 'icon_width' => 69,
                'links' => [
                    ['label' => 'Add Items', 'route' => 'items.create'],
                    ['label' => 'View Items', 'route' => 'items.index'],
                ],
            ],
            [
                'key' => 'vendors',
                'label' => 'Vendor and Supplier Information',
                'pattern' => 'vendors.*',
                'icon' => 'truck.png', 'icon_width' => 80,
                'links' => [
                    ['label' => 'Add Vendor', 'route' => 'vendors.create'],
                    ['label' => 'View Vendor', 'route' => 'vendors.index'],
                ],
            ],
            [
                'key' => 'warehouses',
                'label' => 'Warehouse Zoning and Rack',
                'pattern' => 'warehouses.*',
                'icon' => 'warehouse.png', 'icon_width' => 73,
                'links' => [
                    ['label' => 'Add Warehouse', 'route' => 'warehouses.create'],
                    ['label' => 'View Warehouse', 'route' => 'warehouses.index'],
                ],
            ],
            [
                'key' => 'fleet',
                'label' => 'Operational Fleet',
                'pattern' => 'fleet.*',
                'icon' => 'gear.png', 'icon_width' => 64,
                'links' => [
                    ['label' => 'Add Operational', 'route' => 'fleet.create'],
                    ['label' => 'View Operational', 'route' => 'fleet.index'],
                ],
            ],
        ];
    }
}
