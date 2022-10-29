@extends('mail.base')

@section('content')
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="header">
        <tr>
            <td colspan="2" align="center" class="header" bgcolor="#ffed7f" style="padding: 15px;">
                <font color="#e97e84">{{ $contact->subject ?? '' }}</font>
            </td>
        </tr>
        <tr>
            <td colspan="2" bgcolor="#ffffff" style="padding-bottom: 75px">
                <table width="400" border="0" align="center" cellpadding="10" cellspacing="0">
                    <tbody>
                    <tr>
                        <td>
                            <p>
                                Informasi Pengirim:
                            </p>
                            <p>
                                Name: {{ $contact->name ?? '' }}
                            </p>
                            <p>
                                Email: {{ $contact->email ?? '' }}
                            </p>
                            <p>
                                Phone: {{ $contact->phone ?? '' }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Message:
                            </p>
                            <p>
                                {{ $contact->message ?? '' }}
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
@stop
