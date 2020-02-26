@extends('layouts.print')

@section('content')
    <div  class="row" >
        <div class="col-md-3" style="border:1px solid black; text-align:center;">
            @php
                $url = url('/test-suits/runtest/' . $id);
                echo QrCode::size(250)->generate($url);
            @endphp
        </div>
    </div>
                
            </td>
        </tr>
    </table>
    
@endsection