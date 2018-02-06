<!-- resources/views/lk/referals/list.blade.php -->
{{--{{dd($data['refs'])}}--}}
    <!-- Bootstrap шаблон... -->

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->

    <!-- Текущие ссылки -->
        @if (count($data['refs']['links'])>0)
        <div class="panel panel-default">
            <div class="panel-body ref-panel-body">
                <table class="table table-sm table-hover table-referals">

                    <thead>
                        <th>@lang('home/referals.link')</th>
                        <th>@lang('home/referals.conversion')</th>
                        <th>@lang('home/referals.comment')</th>
                        <th colspan="2" width="250px">@lang('home/referals.action')</th>
                    </thead>

                    <tbody>
                    @foreach ($data['refs']['links'] as $link)
                        <tr>
                            <td class="table-text">
                              <input type="text" readonly="readonly" class="my-input ref-link-input ref-link-input{{ $link['id'] }}" value="{{ route('refer',['refer' => $link['id']]) }}">
                            </td>
                            <td class="table-text">
                                <div>{{ $link->conversions->count() }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $link['comment'] }}</div>
                            </td>
                            <td class="btn-td">
                              <div class="td-inner-box">
                                <div type="button" class="btn btn-success btn-copy">
                                  {{--<i class="fa fa-check" aria-hidden="true"></i>--}}
                                  <i class="fa fa-btn fa-files-o"></i> @lang('home/referals.copy')
                                </div>
                              </div>
                            </td>
                          <td class="btn-td">
                            <div class="td-inner-box">
                              <form id="{{$link['id']}}" action="{{ url('/referals/links/'.$link['id']) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                  <i class="fa fa-btn fa-trash"></i> @lang('home/referals.delete')
                                </button>
                              </form>
                            </div>
                          </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    @endif

    <!-- Форма добавления новой ссылки -->
        <form action="{{ url('referals') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- ID ссылки (affiliate_id) -->
            <div class="form-group col-sm-12">
                <br>
                <div class="row ref-row">
                    <div class="div col-sm-4">
                      <input type="text" name="comment" id="comment" class="my-input ref-link-input" placeholder="@lang('home/referals.comment')">
                        <div class="error-message error-message1 comment"></div>
                    </div>
                    <div class="div col-sm-4">
                        <button type="submit" class="reusable-btn change-btn" style="height: 50px;">
                            <i class="fa fa-plus"></i> @lang('home/referals.add_link')
                        </button>
                    </div>
                </div>
            </div>

            <!-- Кнопка добавления ссылки -->

        </form>
    </div>

<script>

  setTimeout(function(){
	  var btn = document.getElementsByClassName("btn-copy");

	  for (var i = 0; i < btn.length; i++) {
		  btn[i].addEventListener('click', function(){
        var copyThisText = this.parentElement.parentElement.parentElement.childNodes[0].childNodes[0];
        if(copyThisText === undefined) {
	        copyThisText = this.parentElement.parentElement.parentElement.childNodes[0].nextElementSibling.childNodes[1];
        }
			  copyThisText.select();
			  try {
                  document.execCommand('copy');

                  var icon = $(this).find('i');
                  icon.toggleClass('fa-files-o', false).toggleClass('fa-check', true);
                  setTimeout(function() {
                    icon.toggleClass('fa-files-o', true).toggleClass('fa-check', false);
                  }, 1000);

			  } catch (err) {
				  console.log('Oops, unable to copy');
			  }
      }, false);
	  }
  },200);

	if (typeof $ != 'undefined') {
		form = $('form');
		form.each(ajax_form);
	}



</script>