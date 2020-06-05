$("#datepicker").datepicker({
  showMonthAfterYear: true,
  yearSuffix: '年',
  monthNamesShort:["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"],
  dayNamesMin: ['日', '月', '火', '水', '木', '金', '土'],
  dateFormat: 'yy-mm-dd',
  showAnim: 'fadeIn',
  showMonthAfterYear: true,
  changeYear: true,
  changeMonth: true,
  yearRange: "-100:-20",
  maxDate: '-240m',
  hideIfNoPrevNext: true,
  defaultDate:"2000-01-01"
});
