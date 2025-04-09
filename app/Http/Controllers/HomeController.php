<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can pass data to your view like this:
        $reviews = [
            ['text' => "The best Indian food I've ever had!", 'author' => 'Sarah J.'],
            ['text' => "Amazing experience!", 'author' => 'James K.'],
            ['text' => "Never disappoints!", 'author' => 'Priya R.']
        ];

        return view('home', [
            'reviews' => $reviews
        ]);
    }
}