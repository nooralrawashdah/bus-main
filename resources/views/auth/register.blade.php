<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>sign up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body dir="rtl">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>انشاء حساب </h4>
                </div>
                <div class="card-body">

                    <!-- عرض الأخطاء -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- الاسم -->
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="mb-3">
                            <label for="password" class="form-label">password </label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label"> password_confirmation </label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">phone_number </label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <!-- المنطقة -->
                        <div class="mb-3">
                            <label for="region_id" class="form-label">address</label>
                            <select class="form-select" id="region_id" name="region_id" required>
                                <option value="">address</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- نوع المستخدم -->
                        <div class="mb-3">
                            <label for="user_type" class="form-label">user type</label>
                            <select class="form-select" id="user_type" name="user_type" required>
                                <option value="">user type</option>
                                <option value="driver">driver</option>
                                <option value="admin">admin</option>
                                <option value="student">student</option>
                            </select>
                        </div>

                        <!-- حقول إضافية حسب النوع -->
                        <div id="extra-fields">
                            <!-- يتم إظهارها ديناميكياً بالـ JS -->
                        </div>

                        <button type="submit" class="btn btn-primary w-100">sign up</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS + jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#user_type').on('change', function() {
        let type = $(this).val();
        let extraFields = $('#extra-fields');
        extraFields.html('');

        if (type === 'driver') {
            extraFields.append(`
                <div class="mb-3">
                    <label for="driver_license_number" class="form-label">رقم رخصة السائق</label>
                    <input type="text" class="form-control" id="driver_license_number" name="driver_license_number" required>
                </div>
            `);
        } else if (type === 'admin') {
            extraFields.append(`
                <div class="mb-3">
                    <label for="experience_years" class="form-label">سنوات الخبرة</label>
                    <input type="number" class="form-control" id="experience_years" name="experience_years" required>
                </div>
            `);
        } else if (type === 'student') {
            extraFields.append(`
                <div class="mb-3">
                    <label for="student_number" class="form-label">الرقم الجامعي</label>
                    <input type="text" class="form-control" id="student_number" name="student_number" required>
                </div>
            `);
        }
    });

</script>

</body>
</html>
