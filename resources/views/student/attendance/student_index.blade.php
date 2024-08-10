<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الحضور والغياب</title>

    <!-- css and js -->
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="p-2 bg-gray-300">

    <div class="py-2 flex justify-center">
        <span class="bg-white rounded p-1 "> {{ $title }}</span>
    </div>

    <div x-data="studentAttendanceRecordDaily({{ $studentHasRecordDailys }},'{{ route('api.admin.student.student_has_record_daily.update')}}' )">
        
    <div class="fixed h-screen w-full inset-0">
           <div class="flex justify-center items-center h-screen">
           <template x-if="loading">
                <div class="loader"></div>
            </template>
           </div>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-12 gap-3">

            <template x-for="record in studentHasRecordDailys">

                <div @click="updateAttendance(record.id)" class="btn-attendance opacity-95" :class=" record.present ? 'btn-attendance-selected' : 'opacity-30' ">
                    <template x-if=" ! loading">
                        <div>
                            <div x-text="record.student_id" class="text-2xl text-center"></div>

                            <div x-text="record.first_name + ' ' + record.last_name" style="font-size: 8px;"></div>
                        </div>
                    </template>
                </div>

            </template>
        </div>
    </div>
    <script src="/assets/js/alpine-persist.min.js"></script>
</body>

</html>