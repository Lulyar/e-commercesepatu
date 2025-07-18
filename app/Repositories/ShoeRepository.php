<?php

namespace App\Repositories;

use App\Models\Shoe;
use App\Repositories\Contracts\ShoeRepositoryInterface;

class ShoeRepository implements ShoeRepositoryInterface
{
    public function getPopularShoes($limit = 4) // default limit
    {
        return Shoe::with(['category', 'brand'])
                   ->where('is_popular', true)
                   ->take($limit)
                   ->get();
    }

    public function searchByName(string $keyword)
    {
        return Shoe::with(['category', 'brand'])
                   ->where(function($query) use ($keyword) {
                       $query->where('name', 'LIKE', '%' . $keyword . '%')
                             ->orWhereHas('brand', function($brandQuery) use ($keyword) {
                                 $brandQuery->where('name', 'LIKE', '%' . $keyword . '%');
                             });
                   })
                   ->get();
    }

    public function getAllNewShoes()
    {
        return Shoe::with(['category', 'brand'])
                   ->latest()
                   ->get();
    }

    public function find($id)
    {
        return Shoe::find($id);
    }

    public function getPrice($shoeId)
    {
        $shoe = $this->find($shoeId);
        return $shoe ? $shoe->price : 0;
    }
}
