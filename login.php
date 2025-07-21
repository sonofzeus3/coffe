<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Premium - Coffee Haven</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'gradient-x': 'gradient-x 15s ease infinite',
                    },
                    keyframes: {
                        'float': {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        'gradient-x': {
                            '0%, 100%': { 'background-position': '0% 50%' },
                            '50%': { 'background-position': '100% 50%' },
                        },
                    }
                }
            }
        }
    </script>
    
    <style>
        .bg-auth {
            background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }
        .bg-glass {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.45);
        }
    </style>
</head>
<body class="bg-auth min-h-screen flex items-center justify-center p-4">

    <!-- Floating Coffee Elements -->
    <div class="fixed top-20 left-10 opacity-20 animate-float">
        <i class="fas fa-coffee text-amber-400 text-7xl"></i>
    </div>
    <div class="fixed bottom-20 right-10 opacity-20 animate-float" style="animation-delay: 2s;">
        <i class="fas fa-mug-hot text-amber-300 text-8xl"></i>
    </div>

    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-glass rounded-2xl shadow-xl overflow-hidden border border-gray-700/50">
            <!-- Decorative Header -->
            <div class="bg-gradient-to-r from-amber-800 to-amber-600 p-4 text-center">
                <div class="flex items-center justify-center mb-2">
                    <i class="fas fa-mug-hot text-amber-200 text-3xl mr-3"></i>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-amber-100 to-amber-300 bg-clip-text text-transparent">
                        Coffee Haven
                    </h1>
                </div>
                <p class="text-amber-100 text-sm font-medium">Premium Coffee Experience</p>
            </div>
            
            <!-- Login Form -->
            <div class="p-8">
                <h2 class="text-2xl font-bold text-center text-gray-100 mb-1">Welcome Back</h2>
                <p class="text-center text-gray-400 mb-8">Sign in to your account</p>
                
                <form class="space-y-6" action="login_process.php" method="POST">
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
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            <a href="#" class="text-xs font-medium text-amber-400 hover:text-amber-300 transition-colors">
                                Forgot password?
                            </a>
                        </div>
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
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                               class="h-4 w-4 text-amber-500 focus:ring-amber-400 border-gray-600 rounded bg-gray-700">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-300">
                            Remember me
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full py-3 px-4 font-semibold text-white bg-gradient-to-r from-amber-600 to-amber-500 rounded-lg shadow-lg hover:from-amber-700 hover:to-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-amber-500 transition-all duration-300 group">
                            <span class="relative">
                                <span class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-arrow-right animate-pulse"></i>
                                </span>
                                <span class="group-hover:translate-x-3 transition-transform duration-300">
                                    Sign In
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
                
                <!-- Social Login -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-900 text-gray-400">
                                Or continue with
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
                
                <!-- Registration Link -->
                <div class="mt-8 text-center text-sm text-gray-400">
                    Don't have an account? 
                    <a href="register.php" class="font-medium text-amber-400 hover:text-amber-300 transition-colors ml-1">
                        Sign up
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Footer Note -->
        <div class="mt-6 text-center text-xs text-gray-500">
            By signing in, you agree to our 
            <a href="#" class="text-amber-400 hover:text-amber-300 transition-colors">Terms of Service</a> 
            and 
            <a href="#" class="text-amber-400 hover:text-amber-300 transition-colors">Privacy Policy</a>.
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>