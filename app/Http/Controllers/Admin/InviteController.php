// app/Http/Controllers/Admin/InviteController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function accept(Request $request, $token)
    {
        // middleware already validated and attached the invitation model
        $invitation = $request->attributes->get('invitation');

        if (! $invitation) {
            return redirect()->route('token.status', ['type' => 'invite', 'reason' => 'invalid']);
        }

        return view('admin.invites.accept', ['token' => $token]);
    }
}
