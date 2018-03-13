<?php

Breadcrumbs::register('catalog.index', function ($breadcrumbs) {
    $breadcrumbs->push(__('category.category_breadcrumb_title'), route('catalog.index'));
});

Breadcrumbs::register('catalog', function ($breadcrumbs, $category) {

    /** @var \App\Category $category */
    if ($category->parent) {
        $breadcrumbs->parent('catalog', $category->parent);
    } else {
        $breadcrumbs->parent('catalog.index');
    }

    $breadcrumbs->push($category->title, route('catalog.slug', ['slug' => $category->alias]));
});

Breadcrumbs::register('product', function ($breadcrumbs, $product) {

    /** @var \App\Product $product */
    if ($product->category) {
        $breadcrumbs->parent('catalog', $product->category);
    } else {
        $breadcrumbs->parent('catalog.index');
    }

    $breadcrumbs->push($product->title, route('product.slug', ['slug' => $product->alias]));
});