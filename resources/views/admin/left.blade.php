@foreach($leftmenu as $lm)
	<h3 class="left_h3"><i class="icon fa fa-arrows"></i>{{ $lm['name'] }}</h3>
	<ul class="left_list">
		@foreach($lm['submenu'] as $slm)
		<li class="sub_menu clearfix" id="left_menu{{ $slm['id'] }}"><i class="icon fa fa-fire"></i><a href="javascript:_LM({{ $slm['id'] }},'/admin/{{ $slm['url'] }}')" class="sub_menu_a">{{ $slm['name'] }}</a></li>
		@endforeach
	</ul>
@endforeach
