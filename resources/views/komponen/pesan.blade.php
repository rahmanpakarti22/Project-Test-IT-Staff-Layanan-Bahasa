@if (Session::has('Berhasil'))
          <div class="pt-3">
            <div class="alert alert-succsess">
              {{ Session::get('Berhasil') }}
            </div>
          </div>
      @endif

      @if ($errors->any())
      <div class="pt-3">
          <div class="alert alert-denger">
              <ul>
                  @foreach ($errors->all() as $item)
                      <li>
                          {{$item}}
                      </li>
                  @endforeach
              </ul>
          </div>
      </div>    
  @endif