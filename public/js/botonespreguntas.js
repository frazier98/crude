$('#Eliminarinput').attr('disabled', 'disabled');
$('#CrearInput').click(function() {
	var num = $('.clonedInput').length;
	var newNum = new Number(num + 1);

	var newElem = $('#input' + num).clone().attr('id', 'Add' + newNum);
	newElem.children(':last').attr('id', 'name' + newNum).attr('name', 'name' + newNum);
	$('#input' + num).after(newElem);
	$('#Eliminarinput').attr('disabled', false);

	if (newNum == 10) {
		$('#CrearInput').attr('disabled', 'disabled');
	}
});

$('#Eliminarinput').click(function() {
	var num = $('.clonedInput').length;
	$('#input' + num).remove();
	$('#CrearInput').attr('disabled', false);

	if (num-1 == 1)
		$('#Eliminarinput').attr('disabled', 'disabled');
});