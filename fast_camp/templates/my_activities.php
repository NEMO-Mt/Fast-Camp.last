<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAST CAMP - กิจกรรมของฉัน</title>
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
            <a href="/my_activities" class="text-primary font-medium border-b-2 border-primary transition">กิจกรรมของฉัน</a>
            <a href="/create" class="text-gray-500 hover:text-primary transition font-medium border-b-2 border-transparent">สร้างกิจกรรม</a>
            <a href="/profile" class="text-gray-500 hover:text-primary transition font-medium border-b-2 border-transparent">โปรไฟล์</a>
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
                <a href="/my_activities" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-secondary text-primary font-medium">
                    <i class="fa-solid fa-calendar-check w-5"></i> กิจกรรมของฉัน
                </a>
                <a href="/create" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 font-medium transition">
                    <i class="fa-solid fa-plus w-5"></i> สร้างกิจกรรม
                </a>
                <a href="/profile" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 font-medium transition">
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

    <main class="flex-grow p-4 md:p-8 max-w-7xl mx-auto w-full">
        <div class="mb-6 md:mb-8">
            <h2 class="text-xl md:text-2xl font-bold mb-3 md:mb-4">กิจกรรมที่ฉันสร้าง</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
                <?php foreach ($myActivities as $activity): 
                    $actImages = getActivityImages($activity['activity_id']);
                ?>
                <div class="bg-white rounded-2xl md:rounded-[30px] p-3 md:p-4 pb-4 md:pb-5 shadow-sm hover:shadow-md transition flex flex-col items-center text-center border border-gray-50 h-full">
                    <?php if (!empty($actImages)): ?>
                    <div class="w-full h-28 md:h-40 bg-secondary rounded-xl md:rounded-[20px] mb-3 md:mb-4 overflow-hidden">
                        <img src="/<?php echo htmlspecialchars($actImages[0]['image_path']); ?>" alt="<?php echo htmlspecialchars($activity['title']); ?>" class="w-full h-full object-cover">
                    </div>
                    <?php else: ?>
                    <div class="w-full h-28 md:h-40 bg-secondary rounded-xl md:rounded-[20px] mb-3 md:mb-4 flex items-center justify-center">
                        <i class="fa-regular fa-image text-2xl md:text-4xl text-white/50"></i>
                    </div>
                    <?php endif; ?>
                    <div class="self-start bg-secondary text-primary text-[10px] md:text-xs font-bold py-1 px-2 md:px-3 rounded-full mb-2 md:mb-3 ml-1 md:ml-2">
                        <?php echo date('d/m/Y', strtotime($activity['start_date'])); ?>
                    </div>
                    <h3 class="font-bold text-sm md:text-lg mb-1 md:mb-2 line-clamp-1"><?php echo htmlspecialchars($activity['title']); ?></h3>
                    <p class="text-xs md:text-sm text-gray-500 mb-2 md:mb-4 px-1 md:px-2 leading-tight flex-grow line-clamp-2"><?php echo htmlspecialchars($activity['detail']); ?></p>
                    <div class="flex items-center gap-1 md:gap-2 text-[10px] md:text-xs font-medium text-gray-600 mb-3 md:mb-5">
                        <i class="fa-solid fa-location-dot text-accent"></i>
                        <span class="line-clamp-1"><?php echo htmlspecialchars($activity['location']); ?></span>
                    </div>
                    <a href="/activity/<?php echo $activity['activity_id']; ?>" class="w-full md:w-[90%] bg-secondary hover:bg-blue-200 text-primary font-bold py-2 md:py-2.5 rounded-xl md:rounded-2xl transition text-xs md:text-sm text-center">
                        จัดการ
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if (empty($myActivities)): ?>
            <div class="text-center py-8 bg-white rounded-[30px]">
                <p class="text-gray-500">คุณยังไม่ได้สร้างกิจกรรมใดๆ</p>
                <a href="/create" class="inline-block mt-4 bg-primary text-white px-6 py-2 rounded-full hover:bg-blue-800 transition">สร้างกิจกรรม</a>
            </div>
            <?php endif; ?>
        </div>

        <div>
            <h2 class="text-xl md:text-2xl font-bold mb-3 md:mb-4">กิจกรรมที่ฉันลงทะเบียน</h2>
            <div class="space-y-3 md:space-y-4">
                <?php foreach ($myRegistrations as $reg): ?>
                <div class="bg-white rounded-xl md:rounded-[20px] p-4 md:p-6 shadow-sm border border-gray-50 flex flex-col md:flex-row md:justify-between md:items-center gap-3">
                    <div>
                        <h3 class="font-bold text-base md:text-lg"><?php echo htmlspecialchars($reg['title']); ?></h3>
                        <p class="text-xs md:text-sm text-gray-500">
                            จัดโดย <?php echo htmlspecialchars($reg['owner_name']); ?> | 
                            <?php echo date('d/m/Y', strtotime($reg['start_date'])); ?> - <?php echo date('d/m/Y', strtotime($reg['end_date'])); ?>
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 md:gap-3">
                        <?php if ($reg['status'] === 'pending'): ?>
                            <span class="bg-yellow-100 text-yellow-800 px-2 md:px-3 py-1 rounded-full text-xs md:text-sm">รออนุมัติ</span>
                        <?php elseif ($reg['status'] === 'approved'): ?>
                            <span class="bg-green-100 text-green-800 px-2 md:px-3 py-1 rounded-full text-xs md:text-sm">อนุมัติ</span>
                            <?php if ($reg['is_checkin']): ?>
                                <span class="bg-blue-100 text-blue-800 px-2 md:px-3 py-1 rounded-full text-xs md:text-sm"><i class="fa-solid fa-check"></i> เช็คชื่อแล้ว</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="bg-red-100 text-red-800 px-2 md:px-3 py-1 rounded-full text-xs md:text-sm">ปฏิเสธ</span>
                        <?php endif; ?>
                        <a href="/activity/<?php echo $reg['activity_id']; ?>" class="bg-secondary hover:bg-blue-200 text-primary font-bold py-1.5 md:py-2 px-3 md:px-4 rounded-lg md:rounded-xl transition text-xs md:text-sm">
                            ดูรายละเอียด
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if (empty($myRegistrations)): ?>
            <div class="text-center py-8 bg-white rounded-[30px]">
                <p class="text-gray-500">คุณยังไม่ได้ลงทะเบียนกิจกรรมใดๆ</p>
                <a href="/home" class="inline-block mt-4 bg-primary text-white px-6 py-2 rounded-full hover:bg-blue-800 transition">ค้นหากิจกรรม</a>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
