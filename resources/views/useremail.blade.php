<!DOCTYPE html>
<html>
    <head>
        <table>
            
            <thead>
                Login Information
            </thead>
            <tbody>
                <tr>
                    <h1>
                        Email:{{ $data["email"] }}
                    </h1>
                </tr>
                <tr>
                    <h1>
                        Contact Number:{{ $data["contact_number"] }}
                    </h1>
                </tr>
                <tr>
                    <h1>
                        Name:{{ $data["name"] }}
                    </h1>
                </tr>
                <tr>
                    <h1>
                        Password:{{ $data["password"] }}
                    </h1>
                </tr>
            </tbody>
        </table>
    </head>
    <body>
    </body>
</html>
