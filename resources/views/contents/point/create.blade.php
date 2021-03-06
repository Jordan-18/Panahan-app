@extends('layouts.frontend')

@section('title','Scoring')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Create Score</h1>
      </div>
        <div class="alert alert-success" role="alert" id="error">
            <strong>Perhatian</strong>
            <p>Fitur ini dalam tahap Pengembangan</p>
            <ul>
              <li>Jika Skor Telah Masuk Ke Dalam Table Poin Tidak Akan Bisa Diubah</li>
              <ol>Jika Paksa Di tekan akan Mengisi Ke Kolom</ol>
              <li>Jumlah Input Panah Tidak Dapat Dibatasi Namun Jumlah Point Jika sudah Melebihi Batas Anak Panah Maka Akan Berhenti</li>
            </ul>
        </div>
        {{-- alert-errors --}}
        @if ($errors->any())
        <div class="alert alert-danger" role="alert" id="error">
          Hasil Input ada yang belum Terisi
        </div>
        @endif
              <!-- Start Table -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Point</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        </div>
                          {{-- start --}}
                          <table class="table table-bordered text-center" id="countit">
                            <thead>
                              <tr>
                                <th>NAMA</th>
                                <th>Jarak</th>
                                <th>Tanggal</th>
                                <th>Jenis Busur</th>
                                <th>Rambahan</th>
                              </tr>
                              <tr>
                                @if (Auth::check())
                                  <th>{{Auth::user()->name}}</th>
                                  @else
                                <th>Guest</th>
                                @endif
                                  <th>
                                    <a id="jarak-tembak" data-toggle="modal" data-target="#jarak" style="color: #ff9800">
                                       &#10010; Add</a>
                                  </th>
                                  <th id="date">{{($date)}}</th>
                                  <th>
                                    <a id="jenis-busur" type="submit" data-toggle="modal" data-target="#jenis" style="color: #ff9800">
                                        &#10010; Add</a>
                                  </th>
                                  <th>{{$rambahan}}</th>
                              </tr>
                            </thead>
                            <tbody class="table table-bordered text-center" id="mytable">
                              @for ($i = 0; $i < $rambahan; $i++)
                                  
                              <tr>
                                <th>{{$i}}</th>
                                <td id="input{{$i}}">
                                  0
                                  <input type="text" id="inputset" value="{{$i}}" hidden>
                                </td>
                                <td id="rambahan{{$i}}" class="rambahancount">
                                  <input type="text" id="pointset" value="{{$i}}" hidden>
                                </td>
                                <td>
                                  Max Point
                                  <span style="font-weight: bold">{{$jumlahAP*10}}</span>
                                </td>
                                <td>
                                  <a class="btn btn-primary" id="set{{$i}}" data-toggle="modal" data-target="#staticBackdrop">Set Point</a>
                                </td>
                              </tr>
                              @endfor
                              <tr>
                                <td colspan="3">Total</td>
                                <td><button class="btn btn-primary" id="count" onclick="countpoint()">Count</button></td>
                                <td id="total"></td>
                              </tr>
                            </tbody>
                          </table>
                          {{-- end --}}
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                              <a class="btn btn-success" type="submit" data-toggle="modal" data-target="#point">Submit</a>
                            </div>
                      </div> 
                </div>
            </div>
    </div>
    <!-- Modal add-point-->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Masukkan Point</h5>
          <button type="button" id="close-point-modal" class="btn btn-outline-danger text-reset" data-dismiss="modal" aria-label="Close">&#10060;</button>
          </div>
          <div class="modal-body">
            {{-- start code --}}
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="count-point">0</span>
                  <input type="text" id="display" class="form-control form-control-user" placeholder="Counting">
                </div>
                </div>
              <div class="col-sm-6">
                  <input type="number" id="result" class="form-control form-control-user" placeholder="Result">
              </div>
            </div>
              <table class="m-auto">
                <tr>
                  <td>
                    <button class="button btn-danger" onclick="dis('8')">8</button>
                  </td>
                  <td>
                    <button class="button btn-warning" onclick="dis('9')">9</button>
                  </td>
                  <td>
                    <button class="button btn-warning" onclick="dis('10')">10</button>
                  </td>
                  <td>
                    <button class="button btn-warning" onclick="dis('10')">10*</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button class="button btn-danger" onclick="dis('7')">7</button>
                  </td>
                  <td>
                    <button class="button btn-primary" onclick="dis('6')">6</button>
                  </td>
                  <td>
                    <button class="button btn-primary" onclick="dis('5')">5</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button class="button btn-white" onclick="dis('2')">2</button>
                  </td>
                  <td>
                    <button class="button btn-dark" onclick="dis('3')">3</button>
                  </td>
                  <td>
                    <button class="button btn-dark" onclick="dis('4')">4</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button class="button btn-white" onclick="dis('1')" >1</button>
                  </td>
                  <td>
                  </td>
                  <td>
                    <button class="but btn-primary" onclick="clr()">C</button>
                  </td>
                  <td>
                    <button type="submit" class="but btn-primary" onclick="setpoint(document.getElementById('pointset').value)">Set Point</button>
                  </td>
                </tr>
              </table>
              {{-- end code --}}
            </div>
            <ul>
              <li style="color: #ff0000">Max Anak Panah <strong><u>{{$jumlahAP}}</u></strong></li>
            </ul>
          </div>
      </div>
      </div>
  <!-- /Modal add-point-->

  <!-- Modal add-jarak-->
  <div class="modal fade" id="jarak" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Jarak Kamu dengan Target</h5>
          <button type="button" id="close-jarak" class="btn btn-outline-danger text-reset" data-dismiss="modal" aria-label="Close">&#10060;</button>
          </div>
          <div class="modal-body">
              {{-- code here --}}
              <table class="m-auto">
                <tr>
                  <td>
                    <button class="jarak btn-primary" onclick="getjarak(15)">15 M</button>
                  </td>
                  <td>
                    <button class="jarak btn-primary" onclick="getjarak(18)">18 M</button>
                  </td>
                  <td>
                    <button class="jarak btn-primary" onclick="getjarak(20)">20 M</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button class="jarak btn-primary" onclick="getjarak(25)">25 M</button>
                  </td>
                  <td>
                    <button class="jarak btn-primary" onclick="getjarak(30)">30 M</button>
                  </td>
                  <td>
                    <button class="jarak btn-primary" onclick="getjarak(45)">45 M</button>
                  </td>
                </tr>
              </table>
              <div class="form-group">
                <label for="usr">Other:</label>
                <input type="number" class="form-control" id="usr" placeholder="Others">
              </div>
              {{-- end code --}}
          </div>
          </div>
      </div>
      </div>
  <!-- /Modal add-jarak-->

  <!-- Modal add-Jenis-->
  <div class="modal fade" id="jenis" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Jenis Busur</h5>
          <button type="button" id="close-modal-busur" class="btn btn-outline-danger text-reset" data-dismiss="modal" aria-label="Close">&#10060;</button>
          </div>
          <div class="modal-body">
              {{-- code here --}}
              <table class="m-auto">
                <tr>
                  <td>
                    <button class="btn btn-secondary" onclick="getjenis('Horsebow')">
                      <img src="{{url('/temp/img/horsebow.png')}}" class="busur">
                      <label class="form-label">Busur Horsebow</label>
                    </button>
                  </td>
                  <td>
                    <button class="btn btn-secondary" onclick="getjenis('Standardbow')">
                      <img src="{{url('/temp/img/standardbow.png')}}" class="busur">
                      <label class="form-label">Busur Standardbow</label>
                    </button>
                  </td>
                </tr>
              </table>
              {{-- end code --}}
          </div>
          </div>
      </div>
      </div>
  <!-- /Modal add-jenis-->

  <!-- Modal point -->
  <div class="modal fade" id="point" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Yakin Ini Score Mu</h5>
          <button type="button" id="close-modal-busur" class="btn btn-outline-danger text-reset" data-dismiss="modal" aria-label="Close">&#10060;</button>
          </div>
          <div class="modal-body">
              {{-- code here --}}
                <form action="{{route('store-point')}}" method="POST">
                  @csrf
                  <label class="form-label">Rambahan</label>
                  <input type="text" name="rambahan" id="form-rambahan" class="form-control" value="{{$rambahan}}" required>
                  <label class="form-label">Jumlah Anak Panah</label>
                  <input type="text" name="jumlah-ap" id="form-jumlah-AP" class="form-control" value="{{$jumlahAP}}" required>
                  <label class="form-label">Jarak</label>
                  <input type="text" name="jarak" id="form-jarak" class="form-control" value="{{ old('jarak')}}">
                  <label class="form-label">Jenis</label>
                  <input type="text" name="jenis" id="form-jenis" class="form-control" value="{{ old('jenis')}}">
                  <label class="form-label">Total</label>
                  <input type="text" name="form-total" id="form-total" class="form-control" value="{{ old('form-total')}}">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                  <button class="btn btn-success" type="submit">Submit</button>
                </div>
              </form>
              {{-- end code --}}
          </div>
          </div>
      </div>
      </div>
  <!-- Modal point-->
  <script>
      setTimeout(() => {
          $('#error').slideUp('fast');
      }, 4000);
    </script>
@endsection