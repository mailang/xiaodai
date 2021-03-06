@extends('layouts.master')
@section('title')
    <h1>
        公司管理
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">公司管理</li>
    </ol>
@endsection
@section('content')
    <script src="{{asset('bootstrap/js/validation.js')}}" type="text/javascript"></script>
    <form class="form-horizontal" id="form" action="/admin/company" method="post" onsubmit="return toVaild()">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">公司信息修改</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body form-horizontal">
                        <div class="form-group">
                            <label for="total_capital" class="col-sm-4 control-label">公司名称（全称）:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" id="name" name="name"
                                       placeholder="公司名称" value="{{$company['name']}}" check-type="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total_capital" class="col-sm-4 control-label">联系人:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" id="contacts" name="contacts"
                                       placeholder="联系人" value="{{$company['contacts']}}" check-type="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="money_capital" class="col-sm-4 control-label">社会信用代码:</label>
                            <div class=" col-sm-4">
                                <input class="form-control" id="code" name="code"
                                       placeholder="社会信用代码" type="text" value="{{$company['code']}}"
                                       check-type="required">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="other_capital" class="col-sm-4 control-label">开业时间:</label>
                            <div class=" col-sm-4">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar">
                                        </i>
                                    </div>
                                    <input class="form-control pull-right" id="opening_at" name="opening_at"
                                           placeholder="开业时间" type="text" data-date-end-date="0d"
                                           value="{{date('Y-m-d',strtotime($company['opening_at']))}}"
                                           check-type="required date">
                                </div>
                            </div>
                        </div>
                        <script language="javascript">
                            $(function () {
                                $('#opening_at').datepicker({
                                    language: "zh-CN",
                                    autoclose: true,
                                    format: "yyyy-mm-dd",
                                    todayBtn: true,
                                    todayHighlight: true


                                })
                            });
                        </script>


                        <div class="form-group">
                            <label for="total_debtcapital" class="col-sm-4 control-label">所属地区:</label>
                            <div class="col-sm-4">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control" name="areacode0" id="areacode0"
                                                check-type="required number" readonly="true">
                                            <option>--请选择--</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="areacode1" id="areacode1"
                                                check-type="required number">
                                            <option>--请选择--</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="areacode2" id="areacode2"
                                                check-type="required number">
                                            <option>--请选择--</option>
                                        </select>
                                    </div>
                                </div>
                                <script language="JavaScript">
                                    $(function () {
                                        var ac = eval({!! $areacode !!});

                                        function refeshselect($o, pcode) {
                                            var p = $.Enumerable.From(ac).Where("x=>x.pcode=='" + pcode + "'").ToArray();
                                            $.each(p, function () {
                                                // ...
                                                $o.append("<option value='" + this.areacode + "'>" + this.name + "</option>");
                                            });
                                        }

                                        refeshselect($("#areacode0"), "000000");
                                        var dataac = "{{$company['areacode']}}";
                                        if (dataac != null && dataac != "" && dataac != undefined) {
                                            var pac = dataac[0] + dataac[1] + "0000";
                                            var cac = dataac[0] + dataac[1] + dataac[2] + dataac[3] + "00";

                                            refeshselect($("#areacode1"), pac);
                                            refeshselect($("#areacode2"), cac);

                                            $("#areacode0").val(pac);
                                            $("#areacode1").val(cac);
                                            $("#areacode2").val(dataac);
                                        }
                                        $("#areacode0").change(function () {
                                            $("#areacode1 option:gt(0)").remove();
                                            $("#areacode2 option:gt(0)").remove();
                                            refeshselect($("#areacode1"), $("#areacode0").val());
                                        });

                                        $("#areacode1").change(function () {
                                            $("#areacode2 option:gt(0)").remove();
                                            refeshselect($("#areacode2"), $("#areacode1").val());
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="paidup_capital" class="col-sm-4 control-label">经营地址:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="经营地址" name="address"
                                       id="address" value="{{$company['address']}}" check-type="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="paidup_capital" class="col-sm-4 control-label">联系电话:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="联系电话" name="tel"
                                       id="tel" value="{{$company['tel']}}" check-type="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">手机号:</label>
                            <div class="col-sm-4">

                                <input class="form-control" type="text" placeholder="手机号" name="phone"
                                       id="phone" value="{{$company['phone']}}" check-type="mobile"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">注册资本金:</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="注册资本金" name="reg_capital"
                                           id="reg_capital" value="{{$company['reg_capital']}}"
                                           check-type="number required"/>
                                    <span class="input-group-addon">万元</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">法人代表:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="法人代表" name="legal_person"
                                       id="legal_person" value="{{$company['legal_person']}}" check-type="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">董事长:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="董事长" name="chairman"
                                       id="chairman" value="{{$company['chairman']}}" check-type="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">总经理:</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" placeholder="总经理" name="manager"
                                       id="manager" value="{{$company['manager']}}" check-type="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">业务范围:</label>
                            <div id="scoplist" class="col-sm-4">
                                <?php $list=explode('|',$company['scope']);?>
                                <input type="checkbox" value="发放小额贷款" @if(in_array("发放小额贷款",$list))checked @endif  id="1st"><label for="1st"> 发放小额贷款</label>
                                <input type="checkbox" value="票据贴现业务" @if(in_array("票据贴现业务",$list))checked @endif id="2nd"><label for="2nd"> 票据贴现业务</label>
                                <input type="checkbox" value="信托代理" @if(in_array("信托代理",$list))checked @endif id="3rd"><label for="3rd"> 信托代理</label><input type="checkbox" value="发行私募债" id="7th"><label for="7th"> 发行私募债</label>
                                <br>
                                <input type="checkbox" value="向大股东定向借款" @if(in_array("向大股东定向借款",$list))checked @endif id="4th"><label for="4th"> 向大股东定向借款</label>
                                <input type="checkbox" value="与符合条件的金融机构开展资产转让业务" @if(in_array("与符合条件的金融机构开展资产转让业务",$list))checked @endif id="5th"><label for="5th"> 与符合条件的金融机构开展资产转让业务</label>
                                <input type="checkbox" value="部分资产收益权转让" @if(in_array("部分资产收益权转让",$list))checked @endif id="6th"><label for="6th"> 部分资产收益权转让</label>
                                <input type="checkbox" value="其他经省金融办批准业务" @if(in_array("其他经省金融办批准业务",$list))checked @endif id="8th"><label for="8th"> 其他经省金融办批准业务</label>
                                 <input type="hidden" value=""  name="scope" id="scope">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">注册资本构成:</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="type" id="type" check-type="required number">
                                    <option>--请选择--</option>
                                    <option value="0">国有控股</option>
                                    <option value="1">民营控股</option>
                                    <option value="2">外资控股</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">业务开展范围:</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="bus_area" id="bus_area" check-type="required number">
                                    <option>--请选择--</option>
                                    <option value="0">县区</option>
                                    <option value="1">市</option>
                                    <option value="2">省</option>
                                </select>
                            </div>
                        </div>
                        <script language="javascript">
                            $(function () {
                                $("#type").val("{{$company['type']}}");
                                $("#bus_area").val("{{$company['bus_area']}}");
                            });
                        </script>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">分支机构数量:</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="分支机构数量" name="branch_num"
                                           id="branch_num" value="{{$company['branch_num']}}"
                                           check-type="integer required"/>
                                    <span class="input-group-addon">个</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profit_income" class="col-sm-4 control-label">从业人员数量:</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="从业人员数量" name="p_num"
                                           id="p_num" value="{{$company['p_num']}}" check-type="integer required"/>
                                    <span class="input-group-addon">个</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="profit_income" class="col-lg-4 control-label">股东情况：</label>
                                <button type="button" class="btn btn-primary addlp">
                                    <span class="glyphicon glyphicon-plus"></span>增加
                                </button>
                            </div>
                        </div>
                        <div class="form-group lpcontent">

                        </div>

                        <script language="javascript">
                            function toDecimal(x) {
                                var f = parseFloat(x);
                                if (isNaN(f)) {
                                    return;
                                }
                                f = Math.round(x * 100) / 100;
                                return f;
                            }
                            $(function () {
                                var html = '                       <div class="row margin lprow">\n' +
                                    '                                <label for="profit_income" class="col-sm-3 control-label">姓名或公司名称:</label>\n' +
                                    '                                <div class="col-sm-2">\n' +
                                    '                                    <div class="input-group">\n' +
                                    '                                        <input check-type="required"  class="form-control lp_name" type="text" placeholder="姓名" name="lp_name"\n' +
                                    '                                               id="lp_name"/>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                                <label for="profit_income" class="col-sm-1 control-label">股本金额:</label>\n' +
                                    '                                <div class="col-sm-2">\n' +
                                    '                                    <div class="input-group">\n' +
                                    '                                        <input check-type="required number" class="form-control lp_money" type="text" placeholder="股份金额" name="lp_money"\n' +
                                    '                                               id="lp_money"/>\n' +
                                    '                                        <span class="input-group-addon">万元</span>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                                <div>\n' +
                                    '                                <label for="profit_income" class="col-sm-1 control-label">股权比例:</label>\n' +
                                    '                                <div class="col-sm-2">\n' +
                                    '                                    <div class="input-group">\n' +
                                    '                                        <input check-type="required number" class="form-control lp_equity" type="text" placeholder="股权比例" name="lp_equity"\n' +
                                    '                                               id="lp_equity"/>\n' +
                                    '                                        <span class="input-group-addon">%</span>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                                <div>\n' +
                                    '                                    <button type="button" class="btn btn-primary sublp">\n' +
                                    '                                        <span class="glyphicon glyphicon-minus"></span>删除\n' +
                                    '                                    </button>\n' +
                                    '                                </div>\n' +
                                    '                            </div>';
                                $(".addlp").click(function () {
                                    $(".lpcontent").append(html);
                                    $(".sublp").click(function () {
                                        $(this).parents(".lprow").remove();

                                    });
                                    $(".lp_money").change(function () {
                                        var equity = toDecimal($(this).val() * 100 / $("#reg_capital").val());
                                        $(this).parents(".lprow").find(".lp_equity").val(equity);
                                    });
                                });
                                var shareholderj = '{!! $company['shareholder'] !!}';
                                if (shareholderj != null && shareholderj != "" && shareholderj != undefined) {
                                    var shareholder = eval(shareholderj);
                                    $.each(shareholder, function (idx, obj) {
                                        $(".lpcontent").append(html);
                                        $(".lpcontent .lp_name:last").val(obj.name);
                                        $(".lpcontent .lp_money:last").val(obj.money);
                                        $(".lpcontent .lp_equity:last").val(obj.equity);
                                        $(".sublp").click(function () {
                                            $(this).parents(".lprow").remove();

                                        });
                                    });
                                }
                            });
                        </script>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <div class="form-group">
                    <div class="row">
                        <div> <label for="profit_income" class="col-lg-4 control-label">企业状态：</label></div>
                      <div class="col-sm-4">  <div class="input-group">
                              <div class="form-control" style="border: none">
                        @switch($company["state"])
                                      @case(1)
                                      正常经营
                                      @break
                                      @case(2)
                                      暂停经营（只收不贷）
                                      @break
                                      @case(3)
                                      停止经营（停止正常经营、失去联系等）
                                      @break
                                      @case(4)
                                      已被取消发放小额贷款试点经营资格
                                      @break
                                      @case(5)
                                      已吊销营业执照
                                      @break
                                      @case(6)
                                      已注销营业执照
                                      @break
                                      @default
                                      未核实
                                      @break
                        @endswitch
                        @if($company["state"]==5)
                       &nbsp;&nbsp;&nbsp; <b> 注销时间: </b>{{date('Y-m-d',strtotime($company["closing_at"])) }}
                        @endif
                              </div></div>
                      </div>
                    </div>
                </div>

                @if('company.show' !=  Route::currentRouteName())
                <input type="hidden" name="areacode" id="areacode"/>
                <input type="hidden" name="shareholder" id="shareholder"/>
                <input type="hidden" name="uid" id="uid" value="{{Auth::user()->id}}"/>

                <div class="box-footer"><label class="col-lg-4 control-label">&nbsp;</label>
                    <button id="btnsubmit" type="submit" class="btn btn-primary">提交</button>
                </div>
                @endif
            </div><!--/.col (right) -->
        </div>
        <script language="javascript">
            $(function () {
                var $inp = jQuery('input:text');
                $inp.bind('keydown', function (e) {
                    var key = e.which;
                    if (key == 13) {
                        e.preventDefault();
                        var nxtIdx = $inp.index(this) + 1;
                        jQuery(":input:text:eq(" + nxtIdx + ")").focus();
                    }
                });
            });
            function toVaild() {
                var areacode = $("#areacode2").val();
                if (areacode == "--请选择--") {
                    $.alert("请选择所在地区");
                    return false;
                }
                $("#areacode").val(areacode);
                var arr = new Array();
                $(".lprow").each(function () {
                    var sh = new Object();
                    sh.name = $(this).find(".lp_name").val();
                    sh.money = $(this).find(".lp_money").val();
                    sh.equity = $(this).find(".lp_equity").val();
                    arr.push(sh);
                });
                var sltype = $("#type").val();
                var slbus_area = $("#bus_area").val();
                if (sltype == null || sltype == "--请选择--") {
                    $.alert("请选择注册资本构成");
                    return false;
                }
                if (slbus_area == null || slbus_area == "--请选择--") {
                    $.alert("请选择业务开展范围");
                    return false;
                }

                var jsonstr = $.toJSON(arr);
                if (jsonstr == "[]") {
                    $.alert("请添加股东信息");
                    return false;
                }
                $("#shareholder").val(jsonstr);

                var alllp_money = 0;
                $(".lp_money").each(function () {
                    alllp_money += Number($(this).val());
                });

                if(!equal($("#reg_capital").val(),alllp_money)) {
                    $.alert("股本金额填写错误！");
                    return false;
                }
                var s="";
                $("#scoplist input:checkbox:checked").each(function () {
                    s+=$(this).val()+"|";
                });
                if(s=="")   {$.alert("业务范围至少选择一项！");
                return false;}else $("#scope").val(s);

                return true;
            }
            function equal(numa,numb){
                return Math.abs(numa - numb) < 0.0000001;
            }

            $(function () {
                $("#form").validation();
                $("#opening_at").change(function () {
                    $(this).validateFieldsingle();
                });
                $("#btnsubmit").on('click', function (event) {
                    // 2.最后要调用 valid()方法。
                    if ($("#form").valid() == false) {
                        //$(".modal-body").text("请正确输入必填项");
                        //$("#myModal").modal('show');
                        $.alert("请正确输入必填项");
                        return false;
                    }
                });
            });
        </script>
        </div>
    </form>
@endsection