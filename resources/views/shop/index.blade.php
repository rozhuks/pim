<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.0/css/all.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-attachment: scroll;
        background-color: #f3f6f7;
    }

    .container {
        display: flex;
        flex-direction: column;
        max-width: 92rem;
        width: 100%;
        margin: 0 auto;
        flex: 1;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-top: 2.5rem;
    }

    input {
        width: 400px;
        margin-left: -100px;
        padding: 15px;
        font-family: "Montserrat", sans-serif;
        color: black !important;
        font-weight: 600;
        border: none;
        border-radius: 5px;
        padding-left: 20px;
    }

    input::placeholder {
        color: #FF2C20;
    }

    button {
        padding: 15px;
        background: #ffffff;
        border: none;
        border-radius: 5px;
    }

    button:hover {
        cursor: pointer;
        opacity: 0.5;
    }

    .products {
        margin-top: 90px;
        font-size: 12px;
    }

    .categories {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    .cat-btn {
        background: #ffffff;
        padding: 10px;
        font-weight: bold;
        opacity: 0.5;
        color: black;
        text-decoration: none;
    }

    .cat-btn.active {
        opacity: 1;
    }

    .cat-btn:hover {
        opacity: 1;
        cursor: pointer;
    }

    .prod-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 24px;
        margin-top: 50px;
    }

    @media (max-width: 1024px) {
        .prod-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .prod-grid {
            grid-template-columns: 1fr;
        }
    }

    .product-image-wrap {
        width: 100%;
        height: 200px;
        margin-bottom: 12px;
    }

    .product-img {
        width: 100%;
    }

    .prod {
        background: #fff;
        padding: 20px;
        width: 250px;
    }

    .product-image-wrap {
        width: 100%;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
    }

    .product-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        display: block;
    }

    .product-info {
        text-align: left;
    }

    .product-category {
        font-size: 10px;
        font-weight: 700;
        color: #777;
        margin-top: 10px;
        text-transform: uppercase;
    }

    .product-title {
        font-size: 16px;
        font-weight: 600;
        margin-top: 0px;
        color: #333333;
    }

    .product-price {
        font-size: 14px;
        margin-top: 0px;
        font-weight: bold;
        font-size: 16px;
    }

    .product-status {
        font-size: 12px;
        font-weight: bold;
    }

    .product-status.available {
        color: green;
    }

    .product-status.unavailable {
        color: red;
    }

    .prod-price-status {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
</style>
<body>

    <div class="container">
        <div class="header">
            <img src="https://www.unimedia.tech/wp-content/uploads/2023/11/2560px-Logo.min_.svg_-e1701109947570.png" width=200 alt="">
            <form method="GET">
                <input type="text" name="search" placeholder="MEKLĒT PRECI PĒC NOSAUKUMA">
            </form>
            <button><i class="fa-regular fa-cart-arrow-down"></i></button>
        </div>

        <div class="products">
            <h1>ELEKTRONIKA</h1>
            <div class="categories">
                <a href="{{ route('shop.index') }}"
                class="cat-btn {{ request('category') ? '' : 'active' }}">
                    VISAS PRECES
                </a>

                <a href="{{ route('shop.index', ['category' => 'portativie-datori']) }}"
                class="cat-btn {{ request('category') == 'portativie-datori' ? 'active' : '' }}">
                    PORTATĪVIE DATORI
                </a>

                <a href="{{ route('shop.index', ['category' => 'telefoni']) }}"
                class="cat-btn {{ request('category') == 'telefoni' ? 'active' : '' }}">
                    TELEFONI
                </a>
            </div>

            <div class="prod-grid">
                @foreach($products as $product) 
                    <div class="prod">

                        <div class="product-image-wrap">
                            <img 
                                src="/product-image/{{ basename($product->image) }}" 
                                alt="{{ $product->name }}"
                                class="product-img"
                            >
                        </div>

                        <div class="product-info">
                            <p class="product-category">
                                {{ $product->category->name }}
                            </p>

                            <h3 class="product-title">
                                {{ $product->name }}
                            </h3>

                            <div class="prod-price-status">
                                <p class="product-price">
                                    €{{ number_format($product->price, 2) }}
                                </p>

                                @if($product->status)
                                    <span class="product-status available">● PIEEJAMS</span>
                                @else
                                    <span class="product-status unavailable">● NAV PIEEJAMS</span>
                                @endif
                            </div>
                        </div>

                    </div> 
                @endforeach
            </div>
        </div>
    </div>













<!-- <body class="bg-gray-100">

<header class="p-4 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <img src="https://www.unimedia.tech/wp-content/uploads/2023/11/2560px-Logo.min_.svg_-e1701109947570.png" width=200 alt="">
    </div>

    <form method="GET" class="flex w-1/2">
        <input 
            type="text" 
            name="search"
            placeholder="MEKLĒT PRECI"
            class="w-full px-5 py-2 border rounded-2"
        >
    </form>

    <button class="bg-yellow-400 p-3 rounded relative">
        🛒
        <span class="absolute -top-2 -right-2 bg-black text-white text-xs px-1 rounded">4</span>
    </button>
</header> -->

<!-- <div class="max-w-6xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">ELEKTRONIKA</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white shadow rounded p-4">
                <img 
                    src="{{ asset('storage/' . $product->image) }}" 
                    class="h-40 mx-auto mb-4 object-contain"
                >

                <p class="text-xs text-gray-500 uppercase">
                    {{ $product->category->name ?? 'Kategorija' }}
                </p>

                <h2 class="font-semibold">
                    {{ $product->name }}
                </h2>

                <p class="font-bold mt-2">
                    €{{ number_format($product->price, 2) }}
                </p>

                @if($product->is_available)
                    <p class="text-green-600 text-sm mt-2">● PIEEJAMS</p>
                @else
                    <p class="text-red-600 text-sm mt-2">● NAV PIEEJAMS</p>
                @endif
            </div>
        @endforeach
    </div>
</div> -->

</body>
</html>
