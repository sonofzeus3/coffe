<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Coffee Experience - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow: hidden;
        }
        #canvas-container {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .login-card {
            transform-style: preserve-3d;
            transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
            transition: transform 0.5s ease;
        }
        .input-3d {
            transform: translateZ(30px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        .btn-3d {
            transform: translateZ(40px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }
        .btn-3d:hover {
            transform: translateZ(50px) scale(1.02);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.5);
        }
        .coffee-steam {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body class="text-gray-100 flex items-center justify-center min-h-screen">

    <!-- 3D Canvas Container -->
    <div id="canvas-container"></div>

    <!-- Coffee Steam Animation -->
    <div class="coffee-steam">
        <div class="absolute top-1/4 left-1/2 w-4 h-16 bg-white opacity-20 rounded-full filter blur-md animate-steam" style="animation-delay: 0s;"></div>
        <div class="absolute top-1/4 left-1/3 w-3 h-12 bg-white opacity-20 rounded-full filter blur-md animate-steam" style="animation-delay: 0.5s;"></div>
        <div class="absolute top-1/4 right-1/3 w-5 h-20 bg-white opacity-20 rounded-full filter blur-md animate-steam" style="animation-delay: 1s;"></div>
    </div>

    <!-- 3D Login Card -->
    <div class="login-card w-full max-w-md mx-4 p-8 bg-gradient-to-br from-amber-900/90 to-amber-700/90 rounded-2xl backdrop-blur-lg border border-amber-600/30 shadow-2xl">
        <div class="text-center mb-10">
            <div class="flex justify-center mb-4">
                <div class="relative w-16 h-16">
                    <div class="absolute inset-0 bg-amber-400 rounded-full transform rotate-45 shadow-lg"></div>
                    <div class="absolute inset-1 bg-amber-300 rounded-full transform -rotate-12 shadow-inner"></div>
                    <i class="fas fa-mug-hot text-amber-800 text-3xl absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
                </div>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-amber-200 to-amber-400 bg-clip-text text-transparent mb-2">
                Coffee Haven
            </h1>
            <p class="text-amber-200">Sign in to your 3D coffee experience</p>
        </div>

        <form class="space-y-6">
            <!-- Email Field -->
            <div class="input-3d">
                <label for="email" class="block text-sm font-medium text-amber-100 mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-amber-300">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input id="email" type="email" class="pl-10 w-full px-4 py-3 bg-amber-900/50 text-white border border-amber-600/50 rounded-lg placeholder-amber-300/50 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition duration-300" placeholder="your@email.com">
                </div>
            </div>

            <!-- Password Field -->
            <div class="input-3d">
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-medium text-amber-100">Password</label>
                    <a href="#" class="text-xs text-amber-300 hover:text-amber-200 transition">Forgot password?</a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-amber-300">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input id="password" type="password" class="pl-10 w-full px-4 py-3 bg-amber-900/50 text-white border border-amber-600/50 rounded-lg placeholder-amber-300/50 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition duration-300" placeholder="••••••••">
                    <button type="button" class="absolute right-3 top-3 text-amber-300 hover:text-amber-200" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember" type="checkbox" class="h-4 w-4 text-amber-500 focus:ring-amber-400 border-amber-600 rounded bg-amber-900/50">
                <label for="remember" class="ml-2 block text-sm text-amber-200">Remember me</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-3d w-full py-3 px-4 font-bold text-amber-900 bg-gradient-to-r from-amber-300 to-amber-400 rounded-lg hover:from-amber-200 hover:to-amber-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-300">
                SIGN IN <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>

        <!-- Social Login -->
        <div class="mt-8">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-amber-600/30"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-transparent text-amber-300/80">Or continue with</span>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-3 gap-3">
                <button type="button" class="py-2 px-4 border border-amber-600/30 rounded-lg shadow-sm bg-amber-900/30 text-sm font-medium text-amber-200 hover:bg-amber-800/50 transition">
                    <i class="fab fa-google"></i>
                </button>
                <button type="button" class="py-2 px-4 border border-amber-600/30 rounded-lg shadow-sm bg-amber-900/30 text-sm font-medium text-amber-200 hover:bg-amber-800/50 transition">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button type="button" class="py-2 px-4 border border-amber-600/30 rounded-lg shadow-sm bg-amber-900/30 text-sm font-medium text-amber-200 hover:bg-amber-800/50 transition">
                    <i class="fab fa-apple"></i>
                </button>
            </div>
        </div>

        <!-- Registration Link -->
        <div class="mt-8 text-center text-sm text-amber-300/80">
            Don't have an account? 
            <a href="#" class="font-medium text-amber-200 hover:text-white transition">Sign up</a>
        </div>
    </div>

    <script>
        // Three.js 3D Scene
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        document.getElementById('canvas-container').appendChild(renderer.domElement);
        
        // Coffee Beans
        const beanGeometry = new THREE.SphereGeometry(0.2, 32, 32);
        const beanMaterial = new THREE.MeshLambertMaterial({ 
            color: 0x6F4E37,
            emissive: 0x3D2B1F,
            emissiveIntensity: 0.2
        });
        
        const beans = [];
        for (let i = 0; i < 50; i++) {
            const bean = new THREE.Mesh(beanGeometry, beanMaterial);
            bean.position.x = (Math.random() - 0.5) * 20;
            bean.position.y = (Math.random() - 0.5) * 20;
            bean.position.z = (Math.random() - 0.5) * 20;
            bean.rotation.x = Math.random() * Math.PI;
            bean.rotation.y = Math.random() * Math.PI;
            beans.push(bean);
            scene.add(bean);
        }
        
        // Coffee Cup
        const cupGeometry = new THREE.CylinderGeometry(1, 0.8, 1.5, 32);
        const cupMaterial = new THREE.MeshPhongMaterial({ 
            color: 0xFFFFFF,
            transparent: true,
            opacity: 0.8,
            specular: 0x111111,
            shininess: 30
        });
        const cup = new THREE.Mesh(cupGeometry, cupMaterial);
        cup.position.z = -5;
        scene.add(cup);
        
        // Coffee Liquid
        const coffeeGeometry = new THREE.CylinderGeometry(0.9, 0.7, 1, 32);
        const coffeeMaterial = new THREE.MeshPhongMaterial({ 
            color: 0x4B3621,
            specular: 0x111111,
            shininess: 50
        });
        const coffee = new THREE.Mesh(coffeeGeometry, coffeeMaterial);
        coffee.position.z = -5;
        coffee.position.y = -0.3;
        scene.add(coffee);
        
        // Steam Particles
        const steamParticles = [];
        const steamGeometry = new THREE.SphereGeometry(0.05, 16, 16);
        const steamMaterial = new THREE.MeshBasicMaterial({ 
            color: 0xFFFFFF,
            transparent: true,
            opacity: 0.6
        });
        
        for (let i = 0; i < 20; i++) {
            const particle = new THREE.Mesh(steamGeometry, steamMaterial);
            particle.position.set(
                Math.random() * 0.6 - 0.3,
                Math.random() * 0.5 + 0.8,
                -5 + Math.random() * 0.6 - 0.3
            );
            steamParticles.push({
                mesh: particle,
                speed: Math.random() * 0.02 + 0.01,
                startY: particle.position.y
            });
            scene.add(particle);
        }
        
        // Lights
        const ambientLight = new THREE.AmbientLight(0x404040);
        scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0xFFFFFF, 0.8);
        directionalLight.position.set(1, 1, 1);
        scene.add(directionalLight);
        
        const backLight = new THREE.DirectionalLight(0xFFFFFF, 0.5);
        backLight.position.set(-1, -1, -1);
        scene.add(backLight);
        
        camera.position.z = 5;
        
        // Mouse Move Parallax Effect
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth) * 2 - 1;
            const y = -(e.clientY / window.innerHeight) * 2 + 1;
            
            // Rotate coffee cup slightly
            cup.rotation.x = y * 0.1;
            cup.rotation.y = x * 0.1;
            coffee.rotation.x = y * 0.1;
            coffee.rotation.y = x * 0.1;
            
            // Move camera slightly
            camera.position.x = x * 0.2;
            camera.position.y = y * 0.2;
            
            // Rotate login card in 3D space
            const card = document.querySelector('.login-card');
            card.style.transform = `perspective(1000px) rotateY(${x * 5}deg) rotateX(${y * 5}deg)`;
        });
        
        // Animation Loop
        function animate() {
            requestAnimationFrame(animate);
            
            // Rotate coffee beans
            beans.forEach(bean => {
                bean.rotation.x += 0.01;
                bean.rotation.y += 0.01;
            });
            
            // Animate steam particles
            steamParticles.forEach(p => {
                p.mesh.position.y += p.speed;
                p.mesh.scale.x = p.mesh.scale.y = p.mesh.scale.z = 1 + (p.mesh.position.y - p.startY) * 0.5;
                if (p.mesh.position.y > p.startY + 1.5) {
                    p.mesh.position.y = p.startY;
                    p.mesh.scale.x = p.mesh.scale.y = p.mesh.scale.z = 1;
                }
            });
            
            renderer.render(scene, camera);
        }
        
        // Handle window resize
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
        
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
        
        animate();
    </script>
</body>
</html>