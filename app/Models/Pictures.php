<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pictures extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected function searchName($query)
    {
        return $this->where('name', 'LIKE', '%' . $query . '%')->get();
    }

    protected function searchAbout($query)
    {
        return $this->where('about', 'LIKE', '%' . $query . '%')->get();
    }

    protected function searchSize($query)
    {

        if (Str::contains($query, ',')) {
            $data = explode(',', $query);
        }

        if (Str::contains($query, ' ')) {
            $data = explode(' ', $query);
        }

        if (Str::contains($query, 'x')) {
            $data = explode('x', $query);
        }

        if (Str::contains($query, 'х')) {
            $data = explode('х', $query);
        }


        return $this->where([
            ['width', 'LIKE', '%' . $data[0] . '%'],
            ['height', 'LIKE', '%' . $data[1] . '%'],
        ])->get();
    }


    protected function searchCategory($query)
    {

        $categories = categories::where('name', 'LIKE', '%' . $query . '%')->get();

        // Извлекаем ID каждого элемента из коллекции
        $categoryIds = $categories->pluck('id')->toArray();

        // Используем полученные ID для выполнения второго запроса
        $category_pictures = categories_pictures::whereIn('category_id', $categoryIds)->get();

        $category_picturesIds = $category_pictures->pluck('picture_id')->toArray();

        return $this->whereIn('id', $category_picturesIds)->get();
    }

    protected function searchUnderCategory($query)
    {
        $under_categories = under_categories::where('name', 'LIKE', '%' . $query . '%')->get();

        // Извлекаем ID каждого элемента из коллекции
        $under_categoryIds = $under_categories->pluck('id')->toArray();

        // Используем полученные ID для выполнения второго запроса
        $under_category_pictures = under_categories_pictures::whereIn('under_category_id', $under_categoryIds)->get();

        $under_category_picturesIds = $under_category_pictures->pluck('picture_id')->toArray();

        return $this->whereIn('id', $under_category_picturesIds)->get();
    }
}
