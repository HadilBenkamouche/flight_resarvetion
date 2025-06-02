<?php
session_start();
session_unset();
session_destroy(); // تدمير الجلسة

// إعادة توجيه إلى صفحة logout.php التي ستعرض تصميم logout.html
header("Location:flight_resarvetion\View\client\logout.php");
exit();