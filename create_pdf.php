<?php
define("FPDF_FONTPATH",".");
require("fpdf.php");

// http://goreco.ru/wp-content/themes/template_zm_wordpress/inc/fpdf/create_pdf.php?name_org=%D0%9E%D0%9E%D0%9E%20%22%D0%95%D0%A3%D0%A1%D0%A2%22&inn=77125693450&kpp=451246789678&address_org=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,%20%D0%9A%D1%80%D0%B5%D0%BC%D0%BB%D1%8C,%20%D0%BE%D1%84.%20777&address=%D0%B3.%20%D0%92%D0%B0%D1%88%D0%B8%D0%BD%D0%B3%D0%BE%D0%BD,%20%D1%83%D0%BB.%20%D0%AF%D0%B4%D0%B5%D1%80%D0%BD%D0%BE%D0%B9%20%D0%B2%D0%BE%D0%B9%D0%BD%D1%8B,%2013

$NumberOrderShort = time() - strtotime("today");
$NumberOrderFull = $NumberOrderShort . "-ONPAY от " . date("d.m.y");

$address = $_POST["address"];
$name_org = $_POST["name_org"];
$inn = $_POST["inn"];
$kpp = $_POST["kpp"];
$address_org = $_POST["address_org"];



$pdf = new FPDF();
$pdf->AddFont("Calibri","","calibri.php");
$pdf->AddFont("Calibri","B","calibri-bold.php");
$pdf->AddPage();
$pdf->SetLineWidth(0.1);

// ШАПКА СЧЕТА
$pdf->SetFont("Calibri","",11);
$pdf->Cell(110,6,iconv("utf-8", "windows-1251", 'АО "ТИНЬКОФФ БАНК"'),"LT",0);
$pdf->Cell(15, 6,iconv("utf-8", "windows-1251", "БИК"),1,0);
$pdf->Cell(0,  6,iconv("utf-8", "windows-1251", "044525974"),"RT",1);

$pdf->SetFont("Calibri","",9);
$pdf->Cell(110,6,iconv("utf-8", "windows-1251", "Банк получателя"),"LB",0);
$pdf->Cell(15, 6,iconv("utf-8", "windows-1251", "Сч. №"),1,0);
$pdf->SetFont("Calibri","",11);
$pdf->Cell(0,  6,iconv("utf-8", "windows-1251", "30101810145250000974"),"RB",1);

$pdf->SetFont("Calibri","",11);
$pdf->Cell(55,6,iconv("utf-8", "windows-1251", "ИНН 781138113376"),1,0);
$pdf->Cell(55,6,iconv("utf-8", "windows-1251", ""),1,0);
$pdf->SetFont("Calibri","",9);
$pdf->Cell(15,6,iconv("utf-8", "windows-1251", "Сч. №"),"RTL",0);
$pdf->SetFont("Calibri","",11);
$pdf->Cell(0,6,iconv("utf-8", "windows-1251", "40802810900000046840"),"RT",1);

$pdf->SetFont("Calibri","",11);
$pdf->Cell(110,6,iconv("utf-8", "windows-1251", "ИП Дорошенко Евгений Андреевич "),"LT",0);
$pdf->Cell(15, 6,iconv("utf-8", "windows-1251", ""),"RL",0);
$pdf->Cell(0,  6,iconv("utf-8", "windows-1251", ""),"RL",1);

$pdf->SetFont("Calibri","",9);
$pdf->Cell(110,6,iconv("utf-8", "windows-1251", "Получатель"),"LB",0);
$pdf->Cell(15, 6,iconv("utf-8", "windows-1251", ""),"RBL",0);
$pdf->Cell(0,  6,iconv("utf-8", "windows-1251", ""),"RBL",1);
//--------



$pdf->SetFont("Calibri","B",15);
$pdf->Write(6," \n");
$pdf->Cell(0,7,iconv("utf-8", "windows-1251","Счет-договор №$NumberOrderFull"), "B", 1);

$pdf->Write(3," \n");
$pdf->SetFont("Calibri","B",11);
$pdf->Write(5,iconv("utf-8", "windows-1251", "Исполнитель: "));
$pdf->SetFont("Calibri","",11);
$pdf->Write(5,iconv("utf-8", "windows-1251", "Индивидуальный предприниматель Дорошенко Евгений Андреевич \n"));
$pdf->Write(5,iconv("utf-8", "windows-1251", "ИНН 781138113376, ОГРН 315784700126015, \n"));
$pdf->Write(5,iconv("utf-8", "windows-1251", "188669, Ленинградская обл., Всеволожский р-н, Мурино, Кооперативная, 20б, офис 323 \n"));

$pdf->Write(1," \n");

$pdf->SetFont("Calibri","B",11);
$pdf->Write(5,iconv("utf-8", "windows-1251", "Заказчик: "));
$pdf->SetFont("Calibri","",11);
$pdf->Write(5,iconv("utf-8", "windows-1251", "$name_org \n"));
$pdf->Write(5,iconv("utf-8", "windows-1251", "ИНН $inn, КПП $kpp, \n"));
$pdf->Write(5,iconv("utf-8", "windows-1251", "$address_org \n"));

$pdf->Write(3," \n");

// вывод таблицы ШАПКА
$pdf->SetFont("Calibri","B",11);
$pdf->Write(5,iconv("utf-8", "windows-1251", "Перечень документов: \n"));
$pdf->Cell(7,5,iconv("utf-8", "windows-1251", "№"), 1, 0, "C");
$pdf->Cell(90,5,iconv("utf-8", "windows-1251", "Вид работ"), 1, 0, "C");
$pdf->Cell(20,5,iconv("utf-8", "windows-1251", "Ед. изм."), 1, 0, "C");
$pdf->Cell(20,5,iconv("utf-8", "windows-1251", "Кол-во"), 1, 0, "C");
$pdf->Cell(25,5,iconv("utf-8", "windows-1251", "Цена"), 1, 0, "C");
$pdf->Cell(0,5,iconv("utf-8", "windows-1251", "Сумма"), 1, 1, "C");

// вывод таблицы ТЕЛО

$stroka[1] = $_POST["title_1"];
$summ[1] = $_POST["summ_1"];
$type_price[1] = $_POST["type_price_1"];
$stroka[2] = $_POST["title_2"];
$summ[2] = $_POST["summ_2"];
$type_price[2] = $_POST["type_price_2"];
$stroka[3] = $_POST["title_3"];
$summ[3] = $_POST["summ_3"];
$type_price[3] = $_POST["type_price_3"];


$offset_Y_for_signa = 225;
for ( $num = 1; $num <= 3; $num++) {
	
	if ($type_price[$num] != "undefined") {
		
		$pdf->SetFont("Calibri","",11);
		$pdf->Cell(7, 5, $num, "LR", 0, "C" );
		$pdf->Cell(90,5,iconv("utf-8", "windows-1251", "Оказание услуг по разработке документа:"), "LR", 0);
		$pdf->Cell(20,5,iconv("utf-8", "windows-1251", "шт."), "LTR", 0, "C");
		$pdf->Cell(20,5,iconv("utf-8", "windows-1251", "1"), "LTR", 0, "C");
		$pdf->Cell(25,5,iconv("utf-8", "windows-1251", $summ[$num]), "LTR", 0, "R");
		$pdf->Cell(0, 5,iconv("utf-8", "windows-1251", $summ[$num]), "LTR", 1, "R");

		$pdf->Cell(7, 5, "", "LRB", 0 );
		$pdf->Cell(90,5,iconv("utf-8", "windows-1251", "$stroka[$num] ($type_price[$num])"), "LRB", 0);
		$pdf->Cell(20,5,iconv("utf-8", "windows-1251", ""), "LBR", 0, "C");
		$pdf->Cell(20,5,iconv("utf-8", "windows-1251", ""), "LBR", 0, "C");
		$pdf->Cell(25,5,iconv("utf-8", "windows-1251", ""), "LBR", 0, "R");
		$pdf->Cell(0, 5,iconv("utf-8", "windows-1251", ""), "LBR", 1, "R");
		$offset_Y_for_signa +=7;
	}
};

// вывод ИТОГО
$pdf->SetFont("Calibri","B",11);
$pdf->Cell(162,5,iconv("utf-8", "windows-1251", "ИТОГО: "), "LBR", 0, "R");
$summ = intval($summ[1])+intval($summ[2])+intval($summ[3]);
$pdf->Cell(0,5,$summ, "LBR", 1, "R");
$pdf->SetFont("Calibri","",11);
$pdf->Write(6, iconv("utf-8", "windows-1251", "Итого к оплате: " . str_price($summ)));

$pdf->Image("signa.jpg", 50, $offset_Y_for_signa, 75);
$pdf->Image("logo-goreco.png",165, 56, 35, 0, "PNG", "https://goreco.ru");

// вывод УСЛОВИЯ ДОГОВОРА
$pdf->SetFont("Calibri","B",11);
$pdf->Write(7," \n");
$pdf->Write(5, iconv("utf-8", "windows-1251", "Основные условия настоящего Счета-договора №$NumberOrderFull: \n"));
$pdf->SetFont("Calibri","",11);
$pdf->Write(5, iconv("utf-8", "windows-1251", "1. Заказчик поручает, а Исполнитель принимает на себя обязательство выполнить работы по разработке паспортов опасных отходов по адресу: $address \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "2. Срок выполнения работ (оказания услуг) Исполнителем составляет =?15= календарных дней. \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "3. Заказчик, обязуется оплатить Исполнителю работы/услуги в следующем порядке: \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "3.1 Авансовый платеж на оказание услуг в размере 100% суммы настоящего договора ($summ руб.) – итоговая цена. \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "3.2 =?Предоставить= Акт выполненных работ по факту оказания услуги. \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "4. Настоящий Счет-договор является основанием для оплаты и является произвольной формой договора оказания услуг согласно ГК РФ от 30.11.1994 № 51-ФЗ - Часть 1, Глава 28, Статья 434. \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "5. Заказчик обязуется предоставить исходные данные для оказания услуг: \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  - полное, сокращенное, фирменное наименование организации; \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  - фамилия, имя, отчество руководителя – полностью, с точным указанием должности; \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  - юридический адрес - с индексом; \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  - адрес площадки (площадок) – с индексом; \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  - ИНН, ОГРН, ОКАТО, ОКВЭД, ОКПО; \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  - телефон, факс, электронная почта; \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  - список отходов с указанием отходообразующих видов деятельности. \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "6. На основании настоящего Счета-договора формируется Акт выполненных работ.  \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "7. Настоящий Счет-договор составлен в двух экземплярах, имеющих равную юридическую силу, по одному для каждой из сторон, и вступает в силу с момента его подписания. \n"));
$pdf->Write(5, iconv("utf-8", "windows-1251", "  \n"));

// signatura
$pdf->Write(15," \n");
$pdf->SetFont("Calibri","B",12);
$pdf->Cell(120, 6,iconv("utf-8", "windows-1251", "Исполнитель: "), 0, 0);
$pdf->Cell(0, 6,iconv("utf-8", "windows-1251", "Дорошенко Евгений Андреевич"), 0, 1);

// save file
$temp = str_replace(['"', ' '], ['', '-'], $name_org);
$filename = date("Y-m-d") . "(" . $NumberOrderShort . ")=" .  $temp . ".pdf";
//$pdf->Cell(120,6,$filename);


$pdf->Output($filename, "F");
//$pdf->Output();
echo $filename;












function str_price($value)
{
	$value = explode('.', number_format($value, 2, '.', ''));
 
	$f = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
	$str = $f->format($value[0]);
 
	// Первую букву в верхний регистр.
	$str = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));
 
	// Склонение слова "рубль".
	$num = $value[0] % 100;
	if ($num > 19) { 
		$num = $num % 10; 
	}	
	switch ($num) {
		case 1: $rub = 'рубль'; break;
		case 2: 
		case 3: 
		case 4: $rub = 'рубля'; break;
		default: $rub = 'рублей';
	}	
	return $str . ' ' . $rub . ' ' . $value[1] . ' копеек.';
}