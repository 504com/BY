���� JFIF      �� *Exif  II*     1           Google  �� � 



	��  # # ��              	
�� 0       ! 1A"2aQu�#47Rcq��              �� -         1!AQq�"a��#2B������   ? �F����UY�>�p��6����{�fҴ�� Q3�<-��ܭwh���ٯ�V��IRG��g��I�� {���\Kpm}&������a����i#��;�j�)v�i�j�:�)�m�Z��f%!�jcP�VM���,�:^�0��-v�Wq��#�O�K�����G�]5m��t�EO5���
��`d	+zr(8s�?ٸdzV��kt�N���ݺQN�{|&����66edf����Mx?~�dG���UI�@����0W��M���T��Y��HV,p�{x��f�  T�I�Rh�LZl�A]�t-�Z�v��SPL�%b\�����?����wmq��s��^s�ŸH�:�Z��.���8���%Ym�^o��]��5�P�_�����S�E���Ј&�"I�lD�.yܹ$sռ���,�`�"�<��^�G����SnE|V�!�.�����O�f��W,�іxRn�`���UX/��:e�-�1D�0�n���;d�]<,k���ӃNG�P���i�KY�J�T(L��l힃Q�٣`���h�����r���J�����7������` |�tт��,}�P���ͭ��
�v����+�V�Mw����Ġ�X1��љ����oo��L���	��F�|ݑ�e���I�u]~�����
׬�����UV�'-��?�P�>b��A�P}8�~�ӕG8s��t��n��Ws-6
j�V�_CS�y�Jy~T�㌫����cߦL&"8�C���d+0|��F7�
_�ݓxҳ|F����%-���'$�}��*����
+M�nF�a�c��6!�w�Ƞ�����%�+N��\8Z[��4U�;�L���,�o�˰���1�=C�����8,����E� �(�
�  u- ($��Wf�����dTm����:��ɭ�[����L�&�I�)��m&q3��?�H���!�Y�A���u�4�|�_�	(�{D.ܳ6	��D+MÖ�Xc`��0���^*(����Z���˜�����a��|��@��#��?.�@t/q�-�U��$kE�U�;a����R~�t5Z_��                                                                            ntials['fb_id'] = null;

        return $credentials;
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        Auth::login($this->findOrCreateUserWithFacebook($user));
        return redirect($this->redirectTo);
    }

    protected function findOrCreateUserWithFacebook($fbUser)
    {
        $user = User::where('fb_id', $fbUser->id)->first();

        if ($user !== null) {
            return $user;
        }

        return User::create([
            'email' => $fbUser->email,
            'firstname' => $fbUser->name,
            'lastname' => $fbUser->nickname,
            'fb_id' => $fbUser->id
        ]);
    }
}
