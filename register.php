<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Premium - Coffee Haven</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        .bg-register {
            background-image: url('https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80');
            background-size: cover;
            background-position: center;
        }
        .bg-glass {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.45);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-register min-h-screen flex items-center justify-center p-4">

    <!-- Floating Coffee Elements -->
    <div class="fixed top-20 left-10 opacity-20 animate-float">
        <i class="fas fa-coffee text-amber-400 text-7xl"></i>
    </div>
    <div class="fixed bottom-20 right-10 opacity-20 animate-float" style="animation-delay: 2s;">
        <i class="fas fa-mug-hot text-amber-300 text-8xl"></i>
    </div>

    <div class="w-full max-w-md">
        <!-- Registration Card -->
        <div class="bg-glass rounded-2xl shadow-xl overflow-hidden border border-gray-700/50">
            <!-- Decorative Header -->
            <div class="bg-gradient-to-r from-amber-800 to-amber-600 p-4 text-center">
                <div class="flex items-center justify-center mb-2">
                    <i class="fas fa-mug-hot text-amber-200 text-3xl mr-3"></i>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-amber-100 to-amber-300 bg-clip-text text-transparent">
                        Coffee Haven
                    </h1>
                </div>
                <p class="text-amber-100 text-sm font-medium">Join Our Coffee Community</p>
            </div>
            
            <!-- Registration Form -->
            <div class="p-8">
                <h2 class="text-2xl font-bold text-center text-gray-100 mb-1">Create Your Account</h2>
                <p class="text-center text-gray-400 mb-8">Start your coffee journey with us</p>
                
                <form class="space-y-5" action="register_process.php" method="POST">
                    <!-- Full Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input id="name" name="name" type="text" required
                                   class="pl-10 w-full px-4 py-3 bg-gray-800/70 text-white border border-gray-700 rounded-lg placeholder-gray-500 focus:outline-none input-focus-effect transition duration-300"
                                   placeholder="John Doe">
                        </div>
                    </div>
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" required
                                   class="pl-10 w-full px-4 py-3 bg-gray-800/70 text-white border border-gray-700 rounded-lg placeholder-gray-500 focus:outline-none input-focus-effect transition duration-300"
                                   placeholder="your@email.com">
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" required
                                   class="pl-10 w-full px-4 py-3 bg-gray-800/70 text-white border border-gray-700 rounded-lg placeholder-gray-500 focus:outline-none input-focus-effect transition duration-300"
                                   placeholder="••••••••">
                            <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-300" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div>
                        <label for="confirm-password" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="confirm-password" name="confirm-password" type="password" required
                                   class="pl-10 w-full px-4 py-3 bg-gray-800/70 text-white border border-gray-700 rounded-lg placeholder-gray-500 focus:outline-none input-focus-effect transition duration-300"
                                   placeholder="••••••••">
                            <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-300" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Terms Agreement -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                   class="h-4 w-4 text-amber-500 focus:ring-amber-400 border-gray-600 rounded bg-gray-700">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-300">
                                I agree to the <a href="#" class="text-amber-400 hover:text-amber-300">Terms of Service</a> and <a href="#" class="text-amber-400 hover:text-amber-300">Privacy Policy</a>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full py-3 px-4 font-semibold text-white bg-gradient-to-r from-amber-600 to-amber-500 rounded-lg shadow-lg hover:from-amber-700 hover:to-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-amber-500 transition-all duration-300 group">
                            <span class="relative">
                                <span class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-mug-hot animate-pulse"></i>
                                </span>
                                <span class="group-hover:translate-x-3 transition-transform duration-300">
                                    Create Account
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
                
                <!-- Social Registration -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-900 text-gray-400">
                                Or sign up with
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-700 rounded-md shadow-sm bg-gray-800 text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors">
                            <i class="fab fa-google text-red-400"></i>
                        </a>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-700 rounded-md shadow-sm bg-gray-800 text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors">
                            <i class="fab fa-facebook-f text-blue-400"></i>
                        </a>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-700 rounded-md shadow-sm bg-gray-800 text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors">
                            <i class="fab fa-apple text-gray-200"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Login Link -->
                <div class="mt-8 text-center text-sm text-gray-400">
                    Already have an account? 
                    <a href="login.php" class="font-medium text-amber-400 hover:text-amber-300 transition-colors ml-1">
                        Sign in
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        
        [togglePassword, toggleConfirmPassword].forEach(button => {
            button.addEventListener('click', function() {
                const inputId = this.id === 'togglePassword' ? 'password' : 'confirm-password';
                const passwordInput = document.getElementById(inputId);
                const icon = this.querySelector('i');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>