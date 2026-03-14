<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAST CAMP - โปรไฟล์</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Kanit', 'sans-serif'] },
                    colors: {
                        primary: '#1c3671',
                        secondary: '#c8defa',
                        surface: '#e3efff',
                        bg_main: '#f2f6fc',
                        accent: '#e93b81'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bg_main font-sans text-primary min-h-screen flex flex-col">
    <nav class="bg-bg_main py-4 px-4 md:px-8 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-2 md:gap-3 cursor-pointer" onclick="window.location.href='/home'">
            <div class="bg-primary text-white w-9 h-9 md:w-10 md:h-10 rounded-lg flex items-center justify-center text-lg md:text-xl shadow-md">
                <i class="fa-solid fa-campground"></i>
            </div>
            <h1 class="text-xl md:text-2xl font-bold tracking-wide">FAST CAMP</h1>
        </div>
        <div class="hidden md:flex bg-white rounded-full shadow-sm px-6 py-2 gap-8 items-center">
            <a href="/home" class="text-gray-500 hover:text-primary transition font-medium border-b-2 border-transparent">หน้าหลัก</a>
            <a href="/my_activities" class="text-gray-500 hover:text-primary transition font-medium border-b-2 border-transparent">กิจกรรมของฉัน</a>
            <a href="/create" class="text-gray-500 hover:text-primary transition font-medium border-b-2 border-transparent">สร้างกิจกรรม</a>
            <a href="/profile" class="text-primary font-medium border-b-2 border-primary transition">โปรไฟล์</a>
        </div>
        
        <!-- Mobile Menu Button -->
        <button onclick="toggleMobileMenu()" class="md:hidden bg-white w-10 h-10 rounded-full shadow-sm flex items-center justify-center">
            <i class="fa-solid fa-bars text-primary"></i>
        </button>

        <div class="hidden md:flex items-center gap-3 cursor-pointer" onclick="window.location.href='/profile'">
            <span class="font-medium"><?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></span>
            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                <img src="https://api.dicebear.com/9.x/micah/svg?seed=<?php echo urlencode($_SESSION['user_email'] ?? 'default'); ?>" alt="Avatar" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenu" class="fixed inset-0 bg-black/50 z-50 hidden">
        <div class="bg-white w-72 h-full ml-auto p-6 shadow-xl">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                        <img src="https://api.dicebear.com/9.x/micah/svg?seed=<?php echo urlencode($_SESSION['user_email'] ?? 'default'); ?>" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <span class="font-medium text-sm"><?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></span>
                </div>
                <button onclick="toggleMobileMenu()" class="text-gray-500 hover:text-gray-800">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <nav class="space-y-2">
                <a href="/home" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 font-medium transition">
                    <i class="fa-solid fa-home w-5"></i> หน้าหลัก
                </a>
                <a href="/my_activities" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 font-medium transition">
                    <i class="fa-solid fa-calendar-check w-5"></i> กิจกรรมของฉัน
                </a>
                <a href="/create" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 font-medium transition">
                    <i class="fa-solid fa-plus w-5"></i> สร้างกิจกรรม
                </a>
                <a href="/profile" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-secondary text-primary font-medium">
                    <i class="fa-solid fa-user w-5"></i> โปรไฟล์
                </a>
            </nav>
            <div class="absolute bottom-6 left-6 right-6">
                <a href="/logout" class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-red-50 text-red-600 font-medium hover:bg-red-100 transition">
                    <i class="fa-solid fa-sign-out-alt"></i> ออกจากระบบ
                </a>
            </div>
        </div>
    </div>
    <script>
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>

    <main class="flex-grow p-3 md:p-10 flex justify-center items-start pb-20">
        <div class="w-full max-w-2xl flex flex-col items-center gap-4 md:gap-6">
            <div class="bg-white rounded-2xl md:rounded-[40px] shadow-sm border border-gray-100 w-full p-5 md:p-8 flex flex-col items-center relative overflow-hidden">
                <?php if (isset($_GET['updated'])): ?>
                <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl md:rounded-2xl mb-4 md:mb-6 text-center text-sm">
                    แก้ไขโปรไฟล์สำเร็จ
                </div>
                <?php endif; ?>
                
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-gray-300 border-4 border-white shadow-md mb-3 md:mb-4 flex items-center justify-center z-10 relative mt-2 md:mt-4 overflow-hidden">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img src="/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Avatar" class="w-full h-full object-cover bg-white">
                    <?php else: ?>
                        <img src="https://api.dicebear.com/9.x/micah/svg?seed=<?php echo urlencode($user['email']); ?>" alt="Avatar" class="w-full h-full object-cover bg-white">
                    <?php endif; ?>
                </div>

                <h2 class="text-xl md:text-2xl font-bold"><?php echo htmlspecialchars($user['full_name']); ?></h2>
                <p class="text-gray-400 text-xs md:text-sm mb-5 md:mb-8"><?php echo htmlspecialchars($user['email']); ?></p>

                <div class="flex gap-3 md:gap-4 w-full justify-center mb-5 md:mb-8">
                    <div class="bg-secondary rounded-xl md:rounded-2xl py-3 md:py-4 px-4 md:px-6 flex flex-col items-center flex-1 max-w-36 md:max-w-40 shadow-sm border border-white">
                        <span class="font-bold text-xs md:text-sm mb-1">กิจกรรมที่สร้าง</span>
                        <span class="text-3xl md:text-4xl font-bold"><?php echo $createdCount; ?></span>
                    </div>
                    <div class="bg-[#4b85c1] text-white rounded-xl md:rounded-2xl py-3 md:py-4 px-4 md:px-6 flex flex-col items-center flex-1 max-w-36 md:max-w-40 shadow-sm border border-white">
                        <span class="font-bold text-xs md:text-sm mb-1">การลงทะเบียน</span>
                        <span class="text-3xl md:text-4xl font-bold"><?php echo $registrationCount; ?></span>
                    </div>
                </div>

                <div class="w-full px-2 md:px-12 mb-5 md:mb-8 text-xs md:text-sm">
                    <h3 class="font-bold text-primary border-b border-primary inline-block mb-3 md:mb-4 pb-0.5 text-sm md:text-base">ข้อมูลส่วนตัว</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 md:gap-y-3 gap-x-4">
                        <div class="flex"><span class="w-16 md:w-20 text-gray-500 font-medium">วันเกิด</span> <span class="font-bold"><?php echo date('d/m/Y', strtotime($user['birthday'])); ?></span></div>
                        <div class="flex"><span class="w-16 text-gray-500 font-medium">อายุ</span> <span class="font-bold"><?php echo $age; ?></span></div>
                        <div class="flex"><span class="w-16 md:w-20 text-gray-500 font-medium">เพศ</span> <span class="font-bold"><?php echo $user['gender'] === 'male' ? 'ชาย' : ($user['gender'] === 'female' ? 'หญิง' : 'อื่นๆ'); ?></span></div>
                        <div class="flex"><span class="w-16 text-gray-500 font-medium">อาชีพ</span> <span class="font-bold"><?php echo htmlspecialchars($user['occupation']); ?></span></div>
                        <div class="flex"><span class="w-16 md:w-20 text-gray-500 font-medium">เบอร์โทร</span> <span class="font-bold"><?php echo htmlspecialchars($user['phone']); ?></span></div>
                    </div>
                </div>

                <div class="w-full bg-secondary/50 rounded-2xl md:rounded-[30px] p-4 md:p-6">
                    <h3 class="font-bold mb-3 md:mb-4 pl-2 text-sm md:text-base">ประวัติการเข้าร่วมกิจกรรม</h3>
                    <div class="space-y-2 md:space-y-3">
                        <button onclick="toggleSection('upcoming')" class="w-full bg-[#4b85c1] text-white font-medium rounded-lg md:rounded-xl px-4 md:px-6 py-2.5 md:py-3 flex justify-between items-center shadow-sm text-sm md:text-base">
                            <span>กำลังจะมาถึง</span>
                            <i id="icon-upcoming" class="fa-solid fa-caret-down"></i>
                        </button>
                        <div id="section-upcoming" class="hidden bg-white rounded-xl p-4">
                            <?php 
                            $upcoming = array_filter($registrations, function($r) { 
                                return strtotime($r['end_date']) >= time() && $r['status'] === 'approved'; 
                            });
                            if (empty($upcoming)): 
                            ?>
                                <p class="text-gray-500 text-center">ไม่มีกิจกรรมที่กำลังจะมาถึง</p>
                            <?php else: 
                                foreach ($upcoming as $reg): 
                            ?>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span><?php echo htmlspecialchars($reg['title']); ?></span>
                                    <span class="text-sm text-gray-500"><?php echo date('d/m/Y', strtotime($reg['start_date'])); ?></span>
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                        
                        <button onclick="toggleSection('past')" class="w-full bg-[#4b85c1] text-white font-medium rounded-xl px-6 py-3 flex justify-between items-center shadow-sm opacity-90">
                            <span>ที่ผ่านมา</span>
                            <i id="icon-past" class="fa-solid fa-caret-down"></i>
                        </button>
                        <div id="section-past" class="hidden bg-white rounded-xl p-4">
                            <?php 
                            $past = array_filter($registrations, function($r) { 
                                return strtotime($r['end_date']) < time() || $r['status'] === 'rejected'; 
                            });
                            if (empty($past)): 
                            ?>
                                <p class="text-gray-500 text-center">ไม่มีประวัติการเข้าร่วม</p>
                            <?php else: 
                                foreach ($past as $reg): 
                            ?>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span><?php echo htmlspecialchars($reg['title']); ?></span>
                                    <span class="text-sm <?php echo $reg['status'] === 'rejected' ? 'text-red-500' : 'text-gray-500'; ?>">
                                        <?php echo $reg['status'] === 'rejected' ? 'ถูกปฏิเสธ' : date('d/m/Y', strtotime($reg['start_date'])); ?>
                                    </span>
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 md:gap-4 w-full justify-center">
                <a href="/edit_profile" class="bg-primary hover:bg-blue-800 text-white font-medium rounded-full py-2.5 md:py-3 px-5 md:px-8 flex items-center gap-2 transition shadow-md flex-1 max-w-40 md:max-w-48 justify-center text-sm md:text-base">
                    <i class="fa-solid fa-pen text-xs md:text-sm"></i>
                    แก้ไขโปรไฟล์
                </a>
                <a href="/logout" class="bg-[#3e527b] hover:bg-[#2c3d5e] text-white font-medium rounded-full py-2.5 md:py-3 px-5 md:px-8 flex items-center gap-2 transition shadow-md flex-1 max-w-40 md:max-w-48 justify-center text-sm md:text-base">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs md:text-sm"></i>
                    ออกจากระบบ
                </a>
            </div>
        </div>
    </main>

    <script>
        function toggleSection(id) {
            const section = document.getElementById('section-' + id);
            const icon = document.getElementById('icon-' + id);
            if (section.classList.contains('hidden')) {
                section.classList.remove('hidden');
                icon.classList.remove('fa-caret-down');
                icon.classList.add('fa-caret-up');
            } else {
                section.classList.add('hidden');
                icon.classList.remove('fa-caret-up');
                icon.classList.add('fa-caret-down');
            }
        }
    </script>
</body>
</html>
