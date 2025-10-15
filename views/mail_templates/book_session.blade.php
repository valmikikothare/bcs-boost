<table cellspacing="0" cellpadding="5" width="100%" bgcolor="#f3f1ed" style="border:2px solid #d3d3d3; font-family:Arial, sans-serif;">
    <tbody>
    <tr>
        <td></td>
        <td width="1000" style="padding-top:20px;">
            <div style="max-width:1000px;min-width:300px;margin:0 auto;">
                <table cellspacing="0" cellpadding="0" width="100%" style="border: 7px solid #d3d3d3; background:white;">
                    <thead>
                        <tr>
                            <td align="left" style="padding: 20px 40px;">
                                <img src="{{ asset('images/user/WhiteLogo.png') }}" alt="Logo" style="max-height: 50px;" />
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="padding: 25px;">
                            <h2 style="color: #333; margin-bottom: 20px;">Booking Details</h2>
                            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse; color:#333;">
                                <tr style="background: #f7f7f7;">
                                    <th align="left" style="border:1px solid #d3d3d3; padding: 10px;">Field</th>
                                    <th align="left" style="border:1px solid #d3d3d3; padding: 10px;">Details</th>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">User Name</td>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">{{ $details['user']->name }}</td>
                                </tr>
                                <tr style="background: #f7f7f7;">
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">Email</td>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">{{ $details['user']->email }}</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">Slot ID</td>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">{{ $details['slot_id'] }}</td>
                                </tr>
                                <tr style="background: #f7f7f7;">
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">Short Description</td>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">{{ $details['agenda'] }}</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">Description</td>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">{{ $details['description'] }}</td>
                                </tr>
                                <tr style="background: #f7f7f7;">
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">Background knowledge expected</td>
                                    <td style="border:1px solid #d3d3d3; padding: 10px;">{{ $details['other_details'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td>
            <div style="max-width:1000px;margin:0 auto;text-align:center; padding:20px 0;">
                <p style="font-size:12px;color:#999;">© 2024 BOOST. All rights reserved.</p>
                <p style="font-size:12px;color:#999;">This is an automatically generated mail. Please do not reply.</p>
            </div>
        </td>
        <td></td>
    </tr>
    </tbody>
</table>