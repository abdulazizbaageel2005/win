<?php 
include './inc/db.php'; 
include './inc/form.php'; 
include './inc/select.php';
include './inc/db_close.php';
?>

<?php include_once './parts/header.php'; ?>

        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center be-light hero">
            <div class="col-md-5 p-lg-5 mx-auto">
                <img src="./images/images.jpg" class="img-fluid mb-3" alt="اربح معنا">
                <h1 class="display-4 fw-normal">اربح مع عزيز</h1>
                <p class="lead fw-normal">باقي على فتح التسجيل</p>
                <h3 id="countdown"></h3>
                <p class="lead fw-normal">للسحب على الجائزة</p>
            </div>

            <div class="container">
                <h3>للدخول في المسابقة اتبع ما يلي:</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">تابع البث المباشر على صفحتي على فيسبوك بالتاريخ المذكور أعلاه</li>
                    <li class="list-group-item">سأقوم ببث مباشر لمدة ساعة عبارة عن أسئلة وأجوبة حرة للجميع</li>
                    <li class="list-group-item">خلال فترة الساعة سيتم فتح صفحة التسجيل هنا حيث ستقوم بتسجيل اسمك وإيميلك</li>
                    <li class="list-group-item">بنهاية البث سيتم اختيار اسم واحد من قاعدة البيانات بشكل عشوائي</li>
                    <li class="list-group-item">الرابح سيحصل على نسخة مجانية من برنامج كامتازيا</li>
                </ul>
            </div>
        </div>

        
        <div class="container">
        <div class="position-relative text-right">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
        <form class="mb-5 registration-card" action="" method="POST">

            <h3>الرجاء أدخل معلوماتك</h3>

            <div class="mb-3">
                <label for="firstName" class="form-label">الاسم الأول</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName, ENT_QUOTES, "UTF-8"); ?>" aria-describedby="emailHelp">
                <div class="form-text error">
                    <?php echo  $errors ['firstNameError'] ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">الاسم الأخير</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName, ENT_QUOTES, "UTF-8"); ?>" aria-describedby="emailHelp">
                <div class="form-text error">
                    <?php echo  $errors ['lastNameError'] ?>
                </div>
            </div>
 
            <div class="mb-3">
                <label for="email" class="form-label">البريد الالكتروني</label>
                <input type="email" class="form-control" id="email" name="email" dir="ltr" value="<?php echo htmlspecialchars($email, ENT_QUOTES, "UTF-8"); ?>" aria-describedby="emailHelp">
                <div class="form-text error">
                    <?php echo  $errors ['emailError'] ?>
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">ارسال المعلومات</button>
        </form>
        </div>
        </div>


    <div class="loader-con" role="status" aria-label="جاري إظهار الفائز">
        <div id="loader">
            <canvas id="circularLoader" width="200" height="200"></canvas><p class="loader-caption">لحظات ونعلن الفائز…</p>
        </div>
    </div>


    <!-- Button trigger modal -->
    <div class="d-grid gap-2 col-6 mx-auto my-5">
        <button type="button" id="winner" class="btn btn-primary" <?php if (empty($users)) echo "disabled"; ?>>
            اختيار الرابح
        </button>
    </div>
    
    <?php if (empty($users)): ?><p class="text-center text-muted">لا يوجد مشاركون حتى الآن. سجّل مشاركًا أولًا.</p><?php endif; ?>
    <div id="confetti" aria-hidden="true"></div>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">الرابح في المسابقة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
                <div class="modal-body text-center">
                    <?php if (!empty($users)): ?><div class="winner-trophy" aria-hidden="true">🏆</div><p class="winner-congrats">ألف مبروك للفائز!</p><?php endif; ?>
                    <?php foreach($users as $user): ?>
                        <h1 class="display-3 text-center winner-name"><?php echo htmlspecialchars($user['firstName']) . ' ' . htmlspecialchars($user['lastName']); ?></h1>
                    <?php endforeach; ?>
                </div>
        </div>
      </div>
    </div>
    
<?php include_once './parts/footer.php'; ?>