@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Satışlar</div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>UserID</th>
                                        <th>Ad</th>
                                        <th>Rol</th>
                                        <th>Üst</th>
                                        <th>Satış Tutarı</th>
                                        <th>Başlangıç Tarihi</th>
                                        <th>Tarih</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td>{{ $sale->id }}</td>
                                            <td>{{ $sale->user->id }}</td>
                                            <td>{{ $sale->user->name }}</td>
                                            <td>
                                                @foreach($sale->user->roles as $role)
                                                    {{ $role->roleLabel() }}
                                                @endforeach
                                            </td>
                                            <td>{{ @$sale->user->parentUser->name }}</td>
                                            <td>{{ $sale->price }} ₺</td>
                                            <td>{{ $sale->user->started_at }}</td>
                                            <td>{{ $sale->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <br>
                    <div class="col-md-12">
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-header badge-danger">Kullanıcı Gibi Giriş Yap</div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad</th>
                                        <th>Rol</th>
                                        <th>Üst</th>
                                        <th>Başlangıç Tarihi</th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    {{ $role->roleLabel() }}
                                                @endforeach
                                            </td>
                                            <td>{{ @$user->parentUser->name }}</td>
                                            <td>{{ $user->started_at }}</td>
                                            <td><a href="{{ route('loginAsUser',$user->id) }}" class="btn btn-success btn-sm">Giriş Yap</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Piriminiz</div>

                            <div class="card-body">
                                <h3 style="color: green">{{ $pay == null ? 0 : $pay }} ₺</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
