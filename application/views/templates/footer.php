<footer class="bg-gradient-to-br from-sky-500 via-sky-400 to-sky-900 text-slate-200 relative overflow-hidden border-t border-sky-700" style="background: linear-gradient(180deg, #2989e9 0%, #4684c6 100%);">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 400 200"><defs><pattern id="footer-dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#footer-dots)"/></svg>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">

            <!-- Brand -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-3 mb-5">
                    <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="Hastaka Holiday" class="w-9 h-9 object-contain">
                    <span class="font-extrabold text-2xl text-white tracking-tight">Hastaka Holiday</span>
                </div>
                <p class="text-slate-300 text-sm leading-relaxed">Sistem rekomendasi paket wisata cerdas menggunakan metode SAW untuk membantu Anda menemukan perjalanan sempurna.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-bold text-white mb-5 flex items-center gap-2">
                    <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-rounded text-sky-400 text-[18px]">navigation</span>
                    </div>
                    Jelajahi
                </h4>
                <ul class="space-y-3">
                    <li><a href="<?= base_url(); ?>" class="text-slate-300 hover:text-sky-400 text-sm transition-all duration-300 flex items-center gap-2.5 group hover:translate-x-1"><span class="material-symbols-rounded text-[16px] group-hover:scale-110 transition-transform">home</span> Home</a></li>
                    <li><a href="<?= base_url('paket'); ?>" class="text-slate-300 hover:text-sky-400 text-sm transition-all duration-300 flex items-center gap-2.5 group hover:translate-x-1"><span class="material-symbols-rounded text-[16px] group-hover:scale-110 transition-transform">luggage</span> Paket Wisata</a></li>
                    <li><a href="<?= base_url('program'); ?>" class="text-slate-300 hover:text-sky-400 text-sm transition-all duration-300 flex items-center gap-2.5 group hover:translate-x-1"><span class="material-symbols-rounded text-[16px] group-hover:scale-110 transition-transform">category</span> Program</a></li>
                    <li><a href="<?= base_url('clients'); ?>" class="text-slate-300 hover:text-sky-400 text-sm transition-all duration-300 flex items-center gap-2.5 group hover:translate-x-1"><span class="material-symbols-rounded text-[16px] group-hover:scale-110 transition-transform">groups</span> Klien</a></li>
                    <li><a href="<?= base_url('pemesanan/tentang_kami'); ?>" class="text-slate-300 hover:text-sky-400 text-sm transition-all duration-300 flex items-center gap-2.5 group hover:translate-x-1"><span class="material-symbols-rounded text-[16px] group-hover:scale-110 transition-transform">search</span> Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-bold text-white mb-5 flex items-center gap-2">
                    <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-rounded text-sky-400 text-[18px]">contact_support</span>
                    </div>
                    Kontak
                </h4>
                <ul class="space-y-3">
                    <li><a href="mailto:admin@hastaka.com" class="text-slate-300 hover:text-sky-400 text-sm transition-all duration-300 flex items-center gap-2.5 group hover:translate-x-1"><span class="material-symbols-rounded text-[16px] group-hover:scale-110 transition-transform">mail</span> admin@hastaka.com</a></li>
                    <li><a href="https://wa.me/6287719646932" target="_blank" class="text-slate-300 hover:text-sky-400 text-sm transition-all duration-300 flex items-center gap-2.5 group hover:translate-x-1"><span class="material-symbols-rounded text-[16px] group-hover:scale-110 transition-transform">chat</span> 0877-1964-6932</a></li>
                    <li><span class="text-slate-300 text-sm flex items-center gap-2.5"><span class="material-symbols-rounded text-[16px] text-slate-400">location_on</span> Indonesia</span></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-sky-700/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-slate-400 text-sm">&copy; <?= date('Y'); ?> Hastaka Holiday. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="text-slate-400 hover:text-sky-400 transition text-sm">Privacy Policy</a>
                <a href="#" class="text-slate-400 hover:text-sky-400 transition text-sm">Terms of Service</a>
            </div>
        </div>
    </div>
    </div>
</footer>
</body>
</html>