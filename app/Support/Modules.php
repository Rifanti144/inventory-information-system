<?php

namespace App\Support;

use App\Models\User;

class Modules
{
    public static function all(): array
    {
        $write = ['admin', 'staff'];

        return [
            [
                'key' => 'items',
                'label' => 'Inventory Master Items',
                'pattern' => 'items.*',
                'icon' => 'box.png', 'icon_width' => 59,
                'links' => [
                    ['type' => 'add', 'label' => 'Add Items', 'route' => 'items.create', 'roles' => $write],
                    ['type' => 'view', 'label' => 'View Items', 'route' => 'items.index'],
                ],
            ],
            [
                'key' => 'vendors',
                'label' => 'Vendor and Supplier Information',
                'pattern' => 'vendors.*',
                'icon' => 'truck.png', 'icon_width' => 68,
                'links' => [
                    ['type' => 'add', 'label' => 'Add Vendor', 'route' => 'vendors.create', 'roles' => $write],
                    ['type' => 'view', 'label' => 'View Vendor', 'route' => 'vendors.index'],
                ],
            ],
            [
                'key' => 'warehouses',
                'label' => 'Warehouse Zoning and Rack',
                'pattern' => 'warehouses.*',
                'icon' => 'warehouse.png', 'icon_width' => 62,
                'links' => [
                    ['type' => 'add', 'label' => 'Add Warehouse', 'route' => 'warehouses.create', 'roles' => $write],
                    ['type' => 'view', 'label' => 'View Warehouse', 'route' => 'warehouses.index'],
                ],
            ],
            [
                'key' => 'fleet',
                'label' => 'Operational Fleet',
                'pattern' => 'fleet.*',
                'icon' => 'gear.png', 'icon_width' => 54,
                'links' => [
                    ['type' => 'add', 'label' => 'Add Operational', 'route' => 'fleet.create', 'roles' => $write],
                    ['type' => 'view', 'label' => 'View Operational', 'route' => 'fleet.index'],
                ],
            ],
        ];
    }

    public static function visibleLinks(array $module, ?User $user): array
    {
        return array_values(array_filter($module['links'], function (array $link) use ($user) {
            if (! isset($link['roles'])) {
                return true;
            }

            return $user !== null && $user->hasRole(...$link['roles']);
        }));
    }
}
