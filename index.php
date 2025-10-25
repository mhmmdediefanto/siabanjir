<?php
session_start();
require("./test/database.php");

$conn = Database::connect();

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

if (isset($_POST['logout'])) {
  unset($_SESSION['user']);
  session_destroy();
  header("Location: login.php");
  exit;
}

// hulu
$stmt = $conn->prepare("SELECT * FROM tbl_sensor_hulu ORDER BY id DESC LIMIT 1");
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// hilir
$datasHilir = $conn->prepare("SELECT * FROM tbl_sensor_hilir ORDER BY id DESC LIMIT 1");
$datasHilir->execute();
$data2 = $datasHilir->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <!-- stylesheet -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <main class="min-h-screen bg-gray-100 w-full pt-2">
    <div class="p-4">
      <form action="" method="POST">
        <button type="submit" name="logout" class="py-2 px-3 bg-blue-700 rounded-lg text-white hover:bg-blue-800">Logout</button>
      </form>
    </div>
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1">
        <div class="w-full text-center py-1">
          <h1 class="text-4xl font-bold">
            Monitoring dan EWS SIABANJIR RealTime
          </h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- card kiri -->
          <div class="grid grid-cols-1">
            <div class="border border-gray-300 p-5">
              <h1 class="text-2xl font-bold text-blue-900 text-center">
                Lokasi 1 Sungai Hulu Tenggeles
              </h1>
              <p class="text-center mt-1">
                <i class="bi bi-geo-alt-fill"></i> Kecamatan Tenggeles
              </p>
            </div>
            <div
              class="bg-gradient-to-r from-stone-900 to-green-700 w-full h-[150px] mb-1">
              <div class="w-full p-5">
                <p class="text-2xl text-white">Ketinggian air 1</p>
                <div class="flex justify-end">
                  <div>
                    <i
                      class="bi bi-rulers text-4xl text-green-900/80 flex justify-center"></i>
                    <p class="text-4xl font-bold text-white"><?= $data['ketinggian_hulu'] ?> cm</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-cols-2 grid gap-1">
              <div
                class="w-full bg-gradient-to-r from-indigo-900 to-slate-500 py-2">
                <h1
                  class="text-2xl font-semibold capitalize text-white text-center py-2 border-b border-gray-300">
                  <i class="bi bi-water"></i>
                  Status Air
                </h1>
                <div
                  class="text-3xl font-semibold flex justify-center items-center text-white text-center pt-2 h-[100px]">
                 <?= $data['status_hulu'] ?>
                </div>
              </div>
              <div
                class="w-full bg-gradient-to-r from-sky-400 to-cyan-200 to-slate-500 py-2">
                <h1
                  class="text-2xl font-semibold text-white text-center py-2 border-b border-gray-300">
                  <i class="bi bi-cloud-drizzle"></i> Curah hujan
                </h1>
                <div
                  class="text-3xl font-semibold capitalize flex justify-center items-center text-white text-center pt-2 h-[100px]">
                   <?= $data['hujan_hulu'] ?>
                </div>
              </div>
            </div>
            <div class="w-full bg-white rounded-xl shadow-lg p-6">
              <h1 class="text-2xl font-semibold mb-2">Grafik Curah Hujan</h1>
              <p class="text-sm text-slate-500 mb-6">
                Data curah hujan per bulan (mm)
              </p>

              <div class="relative">
                <canvas id="rainChart" height="70"></canvas>
              </div>
            </div>
          </div>
          <!-- card kanan -->
          <div class="grid grid-cols-1">
            <div class="border border-gray-300 p-5">
              <h1 class="text-2xl font-bold text-blue-900  text-center">
                Lokasi 1 Sungai Hulu Kesambi
              </h1>
              <p class="text-center mt-1">
                <i class="bi bi-geo-alt-fill"></i> Kecamatan Kesambi
              </p>
            </div>
            <div
              class="bg-gradient-to-r from-stone-900 to-green-700 w-full h-[150px] mb-1">
              <div class="w-full p-5">
                <p class="text-2xl text-white">Ketinggian air 1</p>
                <div class="flex justify-end">
                  <div>
                    <i
                      class="bi bi-rulers text-4xl text-green-900/80 flex justify-center"></i>
                    <p class="text-4xl font-bold text-white"><?= $data2['ketinggian_hilir'] ?> cm</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-cols-1 grid gap-1">
              <div
                class="w-full bg-gradient-to-r from-indigo-900 to-slate-500 py-2">
                <h1
                  class="text-2xl font-semibold text-white text-center py-2 border-b border-gray-300">
                  <i class="bi bi-water"></i>
                  Status Air
                </h1>
                <div
                  class="text-3xl font-semibold flex justify-center items-center text-white text-center pt-2 h-[100px]">
                  <?= $data2['status_hilir'] ?>
                </div>
              </div>
            </div>
            <!-- grafik -->
            <div class="w-full bg-white rounded-xl shadow-lg p-6">
              <h1 class="text-2xl font-semibold mb-2">Grafik Curah Hujan</h1>
              <p class="text-sm text-slate-500 mb-6">
                Data curah hujan per bulan (mm)
              </p>

              <div class="relative">
                <canvas id="sungaiChart" height="70"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="script.js"></script>
</body>

</html>