@foreach($leftmenu as $lm)
	<h3 class="left_h3"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>{{ $lm['name'] }}</h3>
	<ul class="left_list">
		@foreach($lm['submenu'] as $slm)
		<li class="sub_menu clearfix" id="left_menu{{ $slm['id'] }}"><span class="glyphicon glyphicon-leaf" aria-hidden="true"></span><a href="javascript:_LM({{ $slm['id'] }},'/xycms/{{ $slm['url'] }}')" class="sub_menu_a">{{ $slm['name'] }}</a></li>
		@endforeach
	</ul>
@endforeach
