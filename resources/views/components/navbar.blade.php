{{-- Navbar Component --}}
<nav class="bg-white/95 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            {{-- Logo Section --}}
            <div class="flex items-center space-x-2">
                <a href="{{ route('guest.home') }}" class="flex items-center space-x-3 group">
                    {{-- Logo Image --}}
                    <div class="flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('images/fogo.png') }}" class="h-12 md:h-14 w-auto" alt="FoodRescue Logo" />
                    </div>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center space-x-8">

                {{-- Auth Buttons --}}
                <div class="flex items-center space-x-3">
                    <a href="{{ route('filament.user.auth.login') }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-[#00B1CC] border border-gray-300 rounded-lg hover:border-[#00B1CC] transition-all duration-200">
                        Login
                    </a>
                    <a href="{{ route('filament.user.auth.register') }}" 
                    class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                      Register
                  </a>

            </div>

            {{-- Mobile Menu Button --}}
            <div class="md:hidden">
                <button type="button" 
                        class="mobile-menu-button p-2 rounded-lg text-gray-700 hover:text-[#00B1CC] hover:bg-gray-100 transition-colors duration-200"
                        aria-label="Toggle mobile menu">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="mobile-menu hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="px-4 py-6 space-y-4">

            {{-- Mobile Auth Buttons --}}
            <div class="pt-4 border-t border-gray-200 space-y-3">
                <a href="{{ route('filament.user.auth.login') }}" 
                   class="block w-full px-4 py-3 text-center text-gray-700 hover:text-[#00B1CC] border border-gray-300 rounded-lg hover:border-[#00B1CC] font-medium transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
                <a href="{{ route('filament.user.auth.register') }}" 
                   class="block w-full px-4 py-3 text-center text-white bg-gradient-to-r from-[#00B1CC] to-[#0099B8] rounded-lg hover:from-[#0099B8] hover:to-[#007a8a] font-medium transition-all duration-200 shadow-md">
                    <i class="fas fa-user-plus mr-2"></i>Register
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- JavaScript for Mobile Menu Toggle --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    const menuIcon = mobileMenuButton.querySelector('i');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        
        // Toggle icon
        if (mobileMenu.classList.contains('hidden')) {
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        } else {
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-times');
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        }
    });
});
</script>