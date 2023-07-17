<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{url('static/imagenes/Isotipo.png')}}" class="img-fluid">
        </div>

        <div class="user">
            <span class="subtitle"><b>Bienvenido:</b> {{ Auth::user()->name }} {{ Auth::user()->lastname }}</span> <br>
            <span class="subtitle"><b>Rol:</b> {{ getRoleUserArray(null, Auth::user()->role) }}</span>
            <div class="salir">
                Salir
                <a href="{{url('/logout')}}" data-toogle="tooltrip" data-placement="top" title="Salir">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions, 'dashboard'))
                <li>
                    <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fas fa-tachometer-alt"></i> Panel Administrativo</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'dashboard'))
                <li>
                    <a href="{{ url('/admin/reportes') }}" class="lk-dashboard"><i class="fas fa-tachometer-alt"></i> Reportes</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'units'))
                <li>
                    <a href="{{ url('admin/unidades') }}" class="lk-units lk-unit_add lk-unit_edit lk-unit_delete"><i class="fas fa-hospital-user"></i> Unidades</a>
                </li>
            @endif            

            @if(kvfj(Auth::user()->permissions, 'serviceg_list'))
                <li>
                    <a href="{{ url('/admin/servicios_general') }}" class="lk-serviceg_list lk-serviceg_add lk-serviceg_edit  lk-service_list lk-service_add lk-service_edit"><i class="fas fa-bed"></i> Servicios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'studie_list'))
                <li>
                    <a href="{{ url('/admin/estudios/todos') }}" class="lk-studie_list lk-studie_add lk-studie_edit "><i class="fas fa-heartbeat"></i> Examenes / Estudios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'schedule_list'))
                <li>
                    <a href="{{ url('/admin/horarios') }}" class="lk-schedule_list lk-schedule_add lk-schedule_materials "><i class="fa fa-clock-o"></i> Horarios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'patient_list'))
                <li>
                    <a href="{{ url('/admin/pacientes/inicio') }}" class="lk-patient_list lk-patient_add lk-patient_edit lk-patient_history_exam"><i class="fas fa-users"></i> Pacientes</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'appointment_list'))
                <li>
                    <a href="{{ url('/admin/citas') }}" class="lk-appointment_list lk-appointment_add lk-appointment_materials lk-appointment_setting lk-appointment_calendar "><i class="fas fa-calendar-alt"></i> Citas</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_list'))
                <li>
                    <a href="{{ url('/admin/usuarios') }}" class="lk-user_add lk-user_list lk-user_edit lk-user_permissions lk-user_assignments"><i class="fas fa-user-lock"></i> Usuarios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_info'))
                <li>
                    <a href="{{ url('/admin/usuario/cuenta/informacion') }}" class="lk-user_add lk-user_list lk-user_edit lk-user_permissions lk-user_assignments lk-user_info lk-user_change_password"><i class="fas fa-id-card"></i> Información de Cuenta</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'bitacoras'))
                <li>
                    <a href="{{ url('/admin/bitacoras') }}" class="lk-bitacoras "><i class="fas fa-clipboard-list"></i> Bitacoras</a>
                </li>
            @endif
        </ul>
    </div>

</div>
