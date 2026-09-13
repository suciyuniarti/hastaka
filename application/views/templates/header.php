<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($title) ? $title : 'Hastaka Holiday'; ?></title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link rel="stylesheet" href="<?= base_url('application/assets/css/custom.css'); ?>">
<link rel="stylesheet" href="<?= base_url('application/assets/css/admin.css'); ?>">

<script>
tailwind.config={theme:{extend:{colors:{brand:{50:'#f0f9ff',100:'#e0f2fe',200:'#bae6fd',300:'#7dd3fc',400:'#38bdf8',500:'#0ea5e9',600:'#0284c7',700:'#0369a1',800:'#075985',900:'#0c4a6e'},surface:{50:'#f8fafc',100:'#f1f5f9',200:'#e2e8f0',300:'#cbd5e1'}},fontFamily:{sans:['Inter','sans-serif'],heading:['Poppins','sans-serif']}}}}
</script>
<style>
.material-symbols-rounded {
    font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in-up {
    animation: fadeInUp 0.5s ease-out forwards;
}

.animate-slide-down {
    animation: slideDown 0.3s ease-out forwards;
}

.stagger-1 { animation-delay: 0.1s; opacity: 0; animation-fill-mode: forwards; }
.stagger-2 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
.stagger-3 { animation-delay: 0.3s; opacity: 0; animation-fill-mode: forwards; }
.stagger-4 { animation-delay: 0.4s; opacity: 0; animation-fill-mode: forwards; }

.glass {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

.hover-lift {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
}

.gradient-text {
    background: linear-gradient(135deg, #0284c7, #0ea5e9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.gradient-bg {
    background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 50%, #38bdf8 100%);
}

.gradient-bg:hover {
    opacity: 0.9;
}

.btn-icon {
    width: 16px;
    height: 16px;
}

.input-focus, input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
}
</style>
</head>
<body class="bg-white font-sans text-slate-700 antialiased">

