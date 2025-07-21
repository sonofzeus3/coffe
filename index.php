<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Haven - Premium Coffee Experience</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1507133750040-4a8f57021571?ixlib=rb-1.2.1&auto=format&fit=crop&w=1489&q=80');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
        .bg-coffee-overlay {
            background-color: rgba(20, 15, 10, 0.85);
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="text-gray-100">

    <!-- Header -->
    <header class="bg-coffee-overlay sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-mug-hot text-amber-600 text-3xl mr-3"></i>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">Coffee Haven</h1>
                </div>
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="#" class="text-amber-100 hover:text-amber-400 transition duration-300 font-medium">Home</a></li>
                        <li><a href="#" class="text-amber-100 hover:text-amber-400 transition duration-300 font-medium">Menu</a></li>
                        <li><a href="#" class="text-amber-100 hover:text-amber-400 transition duration-300 font-medium">About</a></li>
                        <li><a href="#" class="text-amber-100 hover:text-amber-400 transition duration-300 font-medium">Contact</a></li>
                        <li>
                            <a href="login.php" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-full font-medium transition duration-300 flex items-center">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login
                            </a>
                        </li>
                    </ul>
                </nav>
                <button class="md:hidden text-amber-100 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="container mx-auto px-6 z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 text-amber-100 animate-fade-in-down">
                Artisan Coffee <span class="text-amber-400">Crafted</span> With Love
            </h1>
            <p class="text-xl md:text-2xl text-amber-100 mb-10 max-w-2xl mx-auto">
                Discover our premium selection of specialty coffees sourced from the finest beans around the world.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition duration-300 transform hover:scale-105 shadow-lg">
                    Explore Menu <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="#" class="border-2 border-amber-400 text-amber-100 hover:bg-amber-400 hover:text-gray-900 px-8 py-4 rounded-full text-lg font-semibold transition duration-300 transform hover:scale-105">
                    Book a Table
                </a>
            </div>
        </div>
        <div class="absolute bottom-10 left-0 right-0 flex justify-center">
            <a href="#menu" class="text-amber-100 hover:text-amber-400 animate-bounce">
                <i class="fas fa-chevron-down text-3xl"></i>
            </a>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-20 bg-coffee-overlay">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-amber-100">Our Signature <span class="text-amber-400">Creations</span></h2>
                <div class="w-20 h-1 bg-amber-500 mx-auto mb-6"></div>
                <p class="text-xl text-amber-100 max-w-2xl mx-auto">
                    Each cup is carefully prepared by our master baristas using only the finest ingredients.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Menu Item 1 -->
                <div class="bg-gray-900 rounded-xl overflow-hidden menu-card transition-all duration-300 hover:shadow-xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                             alt="Black Coffee" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-110">
                        <div class="absolute top-4 right-4 bg-amber-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Popular
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-2xl font-bold text-amber-100">Ethiopian Black</h3>
                            <span class="text-xl font-bold text-amber-400">Rp 25.000</span>
                        </div>
                        <p class="text-gray-300 mb-6">Single-origin Ethiopian Yirgacheffe with floral notes and bright acidity.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <button class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded-full text-sm font-medium transition duration-300 flex items-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Add to Order
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Item 2 -->
                <div class="bg-gray-900 rounded-xl overflow-hidden menu-card transition-all duration-300 hover:shadow-xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1568649929103-28ffbefaca1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                             alt="Latte" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-2xl font-bold text-amber-100">Honeycomb Latte</h3>
                            <span class="text-xl font-bold text-amber-400">Rp 35.000</span>
                        </div>
                        <p class="text-gray-300 mb-6">Our signature latte with house-made honeycomb syrup and delicate foam art.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <button class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded-full text-sm font-medium transition duration-300 flex items-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Add to Order
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Item 3 -->
                <div class="bg-gray-900 rounded-xl overflow-hidden menu-card transition-all duration-300 hover:shadow-xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1534778101976-62847782c213?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                             alt="Cappuccino" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-110">
                        <div class="absolute top-4 right-4 bg-amber-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            New
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-2xl font-bold text-amber-100">Cinnamon Cappuccino</h3>
                            <span class="text-xl font-bold text-amber-400">Rp 32.000</span>
                        </div>
                        <p class="text-gray-300 mb-6">Classic cappuccino with a dusting of Vietnamese cinnamon and cocoa.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <button class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded-full text-sm font-medium transition duration-300 flex items-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Add to Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-16">
                <a href="#" class="inline-block border-2 border-amber-400 text-amber-100 hover:bg-amber-400 hover:text-gray-900 px-8 py-3 rounded-full text-lg font-semibold transition duration-300">
                    View Full Menu <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-gray-900 bg-opacity-90">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-amber-100">What Our <span class="text-amber-400">Customers</span> Say</h2>
                <div class="w-20 h-1 bg-amber-500 mx-auto mb-6"></div>
                <p class="text-xl text-amber-100 max-w-2xl mx-auto">
                    Don't just take our word for it - hear from our coffee lovers!
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-amber-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 italic mb-6">"The Ethiopian Black Coffee is simply divine. The floral aroma and bright acidity make it my daily ritual."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah J." class="w-12 h-12 rounded-full mr-4 object-cover">
                        <div>
                            <h4 class="font-bold text-amber-100">Sarah J.</h4>
                            <p class="text-gray-400 text-sm">Coffee Enthusiast</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-amber-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 italic mb-6">"The Honeycomb Latte is unlike anything I've tasted before. Perfect balance of sweetness and coffee flavor."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael T." class="w-12 h-12 rounded-full mr-4 object-cover">
                        <div>
                            <h4 class="font-bold text-amber-100">Michael T.</h4>
                            <p class="text-gray-400 text-sm">Daily Visitor</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-amber-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 italic mb-6">"The ambiance and quality of coffee at Coffee Haven make it my favorite spot for meetings and relaxation."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Priya K." class="w-12 h-12 rounded-full mr-4 object-cover">
                        <div>
                            <h4 class="font-bold text-amber-100">Priya K.</h4>
                            <p class="text-gray-400 text-sm">Remote Worker</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-amber-900 to-amber-700">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6 text-white">Ready to Experience Artisan Coffee?</h2>
            <p class="text-xl text-amber-100 mb-10 max-w-2xl mx-auto">
                Join our coffee community today and get 10% off your first order!
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="login.php" class="bg-white hover:bg-gray-100 text-amber-800 px-8 py-4 rounded-full text-lg font-semibold transition duration-300 transform hover:scale-105 shadow-lg">
                    Sign Up Now <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-amber-800 px-8 py-4 rounded-full text-lg font-semibold transition duration-300 transform hover:scale-105">
                    Book a Tasting
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-mug-hot text-amber-600 text-2xl mr-3"></i>
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">Coffee Haven</h3>
                    </div>
                    <p class="mb-4">Artisan coffee crafted with passion since 2015.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-amber-100 mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-amber-400 transition duration-300">Home</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition duration-300">Menu</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition duration-300">About Us</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition duration-300">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-amber-100 mb-4">Contact Us</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-amber-400"></i>
                            <span>123 Coffee Street, Jakarta</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-amber-400"></i>
                            <span>+62 123 4567 890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-amber-400"></i>
                            <span>hello@coffeehaven.id</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-amber-100 mb-4">Opening Hours</h4>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span>Weekdays</span>
                            <span>7:00 - 21:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Saturday</span>
                            <span>8:00 - 22:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sunday</span>
                            <span>8:00 - 20:00</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p>&copy; <?php echo date("Y"); ?> Coffee Haven. All rights reserved.</p>
                <div class="flex justify-center space-x-6 mt-4">
                    <a href="#" class="hover:text-amber-400 transition duration-300">Privacy Policy</a>
                    <a href="#" class="hover:text-amber-400 transition duration-300">Terms of Service</a>
                    <a href="#" class="hover:text-amber-400 transition duration-300">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>