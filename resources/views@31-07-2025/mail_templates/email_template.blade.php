<table cellspacing="0" cellpadding="5" width="100%" bgcolor="#f3f1ed" style="border:2px solid #d3d3d3">
    <tbody>
        <tr>
            <td></td>
            <td width="1000" style="padding-top:20px;">
                <div style="max-width:1000px;min-width:300px;margin:0 auto;">
                    <table cellspacing="1" cellpadding="0" width="100%" bgcolor="#e5e5e5" style="border-collapse:separate;border: 7px solid #d3d3d3;">
                        <tbody>
                            <tr>
                                <td bgcolor="white">
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="middle" style="padding: 20px 0 20px 40px;">
                                                    <img src="{{asset('images/user/Logo.png')}}" class="img-fluid" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" style="padding:25px;">
                                    <table cellspacing="15" cellpadding="0" width="100%" style="font:15px/20px Arial,sans-serif;color:#000000;border-collapse:separate;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h3>
                                                        {{ strip_tags($data['title']) }} <!-- Display the title from the data array after stripping tags -->
                                                    </h3>
                                                    <p>
                                                        {{ strip_tags($data['content']) }} <!-- Display the content from the data array after stripping tags -->
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
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
                <div style="max-width:560px;margin:0 auto;">
                    <table cellspacing="0" cellpadding="0" align="right" style="font:12px/15px Arial,sans-serif;color:#999999;margin:0 0 20px 20px;">
                        <tbody>
                            <tr>
                                <td align="right">
                                    <div>© 2023 BOOST. All rights reserved.</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="font:12px/15px Arial,sans-serif;color:#999999;">
                        <div style="margin-bottom:1em;">This&nbsp;is&nbsp;an automatically&nbsp;generated&nbsp;mail, please&nbsp;do&nbsp;not&nbsp;reply.</div>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>