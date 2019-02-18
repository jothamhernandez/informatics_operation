@extends('layouts.app')

@section('navigation')
    <navigation :links="['feedback','user','center','cluster','kpi','graph']"></navigation>
@endsection

@section('content')


    <feedback-list v-if="isComponentSelected('feedback')"></feedback-list>
    <user-manager v-if="isComponentSelected('user')"></user-manager>
    <center-manager v-if="isComponentSelected('center')"></center-manager>
    <cluster-manager v-if="isComponentSelected('cluster')"></cluster-manager>
    <kpi-manager v-if="isComponentSelected('kpi')"></kpi-manager>
    <graph-manager v-if="isComponentSelected('graph')"></graph-manager>

@endsection