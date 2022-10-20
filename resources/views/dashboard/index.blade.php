@extends('layouts.app')
@if (Auth::user()->role == 'Admin')
    admin
@elseif (Auth::user()->role == 'Owner')
    owner
@endif
