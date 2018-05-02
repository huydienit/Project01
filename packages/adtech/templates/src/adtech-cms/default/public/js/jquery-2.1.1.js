!function (d, n) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = d.document ? n(d, !0) : function (d) {
        if (!d.document)throw Error("jQuery requires a window with a document");
        return n(d)
    } : n(d)
}("undefined" != typeof window ? window : this, function (d, n) {
    function t(b) {
        var p = b.length, c = f.type(b);
        return "function" === c || f.isWindow(b) ? !1 : 1 === b.nodeType && p ? !0 : "array" === c || 0 === p || "number" == typeof p && 0 < p && p - 1 in b
    }

    function c(b, p, c) {
        if (f.isFunction(p))return f.grep(b, function (b, m) {
            return !!p.call(b, m,
                    b) !== c
        });
        if (p.nodeType)return f.grep(b, function (b) {
            return b === p !== c
        });
        if ("string" == typeof p) {
            if (E.test(p))return f.filter(p, b, c);
            p = f.filter(p, b)
        }
        return f.grep(b, function (b) {
            return 0 <= S.call(p, b) !== c
        })
    }

    function e(b, p) {
        for (; (b = b[p]) && 1 !== b.nodeType;);
        return b
    }

    function g(b) {
        var p = ua[b] = {};
        return f.each(b.match(W) || [], function (b, m) {
            p[m] = !0
        }), p
    }

    function k() {
        K.removeEventListener("DOMContentLoaded", k, !1);
        d.removeEventListener("load", k, !1);
        f.ready()
    }

    function x() {
        Object.defineProperty(this.cache = {}, 0, {
            get: function () {
                return {}
            }
        });
        this.expando = f.expando + Math.random()
    }

    function s(b, p, c) {
        var y;
        if (void 0 === c && 1 === b.nodeType)if (y = "data-" + p.replace(qb, "-$1").toLowerCase(), c = b.getAttribute(y), "string" == typeof c) {
            try {
                c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : rb.test(c) ? f.parseJSON(c) : c
            } catch (d) {
            }
            Z.set(b, p, c)
        } else c = void 0;
        return c
    }

    function G() {
        return !0
    }

    function C() {
        return !1
    }

    function H() {
        try {
            return K.activeElement
        } catch (b) {
        }
    }

    function P(b, p) {
        return f.nodeName(b, "table") && f.nodeName(11 !== p.nodeType ? p : p.firstChild, "tr") ?
            b.getElementsByTagName("tbody")[0] || b.appendChild(b.ownerDocument.createElement("tbody")) : b
    }

    function T(b) {
        return b.type = (null !== b.getAttribute("type")) + "/" + b.type, b
    }

    function ea(b) {
        var p = sb.exec(b.type);
        return p ? b.type = p[1] : b.removeAttribute("type"), b
    }

    function ca(b, p) {
        for (var c = 0, f = b.length; f > c; c++)D.set(b[c], "globalEval", !p || D.get(p[c], "globalEval"))
    }

    function w(b, p) {
        var c, y, d, e, h, l;
        if (1 === p.nodeType) {
            if (D.hasData(b) && (c = D.access(b), y = D.set(p, c), l = c.events))for (d in delete y.handle, y.events = {}, l)for (c =
                                                                                                                                      0, y = l[d].length; y > c; c++)f.event.add(p, d, l[d][c]);
            Z.hasData(b) && (e = Z.access(b), h = f.extend({}, e), Z.set(p, h))
        }
    }

    function F(b, p) {
        var c = b.getElementsByTagName ? b.getElementsByTagName(p || "*") : b.querySelectorAll ? b.querySelectorAll(p || "*") : [];
        return void 0 === p || p && f.nodeName(b, p) ? f.merge([b], c) : c
    }

    function B(b, p) {
        var c, y = f(p.createElement(b)).appendTo(p.body),
            e = d.getDefaultComputedStyle && (c = d.getDefaultComputedStyle(y[0])) ? c.display : f.css(y[0], "display");
        return y.detach(), e
    }

    function q(b) {
        var p = K, c = Xa[b];
        return c ||
        (c = B(b, p), "none" !== c && c || (Ha = (Ha || f("<iframe frameborder='0' width='0' height='0'/>")).appendTo(p.documentElement), p = Ha[0].contentDocument, p.write(), p.close(), c = B(b, p), Ha.detach()), Xa[b] = c), c
    }

    function I(b, p, c) {
        var y, d, e, h, l = b.style;
        return c = c || Ia(b), c && (h = c.getPropertyValue(p) || c[p]), c && ("" !== h || f.contains(b.ownerDocument, b) || (h = f.style(b, p)), Qa.test(h) && Ya.test(p) && (y = l.width, d = l.minWidth, e = l.maxWidth, l.minWidth = l.maxWidth = l.width = h, h = c.width, l.width = y, l.minWidth = d, l.maxWidth = e)), void 0 !== h ? h + "" :
            h
    }

    function V(b, p) {
        return {
            get: function () {
                return b() ? void delete this.get : (this.get = p).apply(this, arguments)
            }
        }
    }

    function L(b, p) {
        if (p in b)return p;
        for (var c = p[0].toUpperCase() + p.slice(1), f = p, d = Za.length; d--;)if (p = Za[d] + c, p in b)return p;
        return f
    }

    function za(b, p, c) {
        return (b = tb.exec(p)) ? Math.max(0, b[1] - (c || 0)) + (b[2] || "px") : p
    }

    function b(b, p, c, y, d) {
        p = c === (y ? "border" : "content") ? 4 : "width" === p ? 1 : 0;
        for (var e = 0; 4 > p; p += 2)"margin" === c && (e += f.css(b, c + ta[p], !0, d)), y ? ("content" === c && (e -= f.css(b, "padding" + ta[p], !0,
            d)), "margin" !== c && (e -= f.css(b, "border" + ta[p] + "Width", !0, d))) : (e += f.css(b, "padding" + ta[p], !0, d), "padding" !== c && (e += f.css(b, "border" + ta[p] + "Width", !0, d)));
        return e
    }

    function ka(m, p, c) {
        var y = !0, d = "width" === p ? m.offsetWidth : m.offsetHeight, e = Ia(m),
            h = "border-box" === f.css(m, "boxSizing", !1, e);
        if (0 >= d || null == d) {
            if (d = I(m, p, e), (0 > d || null == d) && (d = m.style[p]), Qa.test(d))return d;
            y = h && (N.boxSizingReliable() || d === m.style[p]);
            d = parseFloat(d) || 0
        }
        return d + b(m, p, c || (h ? "border" : "content"), y, e) + "px"
    }

    function r(b, p) {
        for (var c,
                 d, e, h = [], l = 0, g = b.length; g > l; l++)d = b[l], d.style && (h[l] = D.get(d, "olddisplay"), c = d.style.display, p ? (h[l] || "none" !== c || (d.style.display = ""), "" === d.style.display && Ba(d) && (h[l] = D.access(d, "olddisplay", q(d.nodeName)))) : (e = Ba(d), "none" === c && e || D.set(d, "olddisplay", e ? c : f.css(d, "display"))));
        for (l = 0; g > l; l++)d = b[l], d.style && (p && "none" !== d.style.display && "" !== d.style.display || (d.style.display = p ? h[l] || "" : "none"));
        return b
    }

    function z(b, p, c, f, d) {
        return new z.prototype.init(b, p, c, f, d)
    }

    function ga() {
        return setTimeout(function () {
            va =
                void 0
        }), va = f.now()
    }

    function l(b, p) {
        var c, f = 0, d = {height: b};
        for (p = p ? 1 : 0; 4 > f; f += 2 - p)c = ta[f], d["margin" + c] = d["padding" + c] = b;
        return p && (d.opacity = d.width = b), d
    }

    function v(b, p, c) {
        for (var f, d = (Da[p] || []).concat(Da["*"]), e = 0, l = d.length; l > e; e++)if (f = d[e].call(c, p, b))return f
    }

    function O(b, p) {
        var c, d, e, l, h;
        for (c in b)if (d = f.camelCase(c), e = p[d], l = b[c], f.isArray(l) && (e = l[1], l = b[c] = l[0]), c !== d && (b[d] = l, delete b[c]), h = f.cssHooks[d], h && "expand" in h)for (c in l = h.expand(l), delete b[d], l)c in b || (b[c] = l[c], p[c] = e);
        else p[d] = e
    }

    function aa(b, p, c) {
        var d, e = 0, l = Ja.length, h = f.Deferred().always(function () {
            delete g.elem
        }), g = function () {
            if (d)return !1;
            for (var p = va || ga(), p = Math.max(0, q.startTime + q.duration - p), c = 1 - (p / q.duration || 0), f = 0, A = q.tweens.length; A > f; f++)q.tweens[f].run(c);
            return h.notifyWith(b, [q, c, p]), 1 > c && A ? p : (h.resolveWith(b, [q]), !1)
        }, q = h.promise({
            elem: b,
            props: f.extend({}, p),
            opts: f.extend(!0, {specialEasing: {}}, c),
            originalProperties: p,
            originalOptions: c,
            startTime: va || ga(),
            duration: c.duration,
            tweens: [],
            createTween: function (p,
                                   c) {
                var d = f.Tween(b, q.opts, p, c, q.opts.specialEasing[p] || q.opts.easing);
                return q.tweens.push(d), d
            },
            stop: function (p) {
                var c = 0, f = p ? q.tweens.length : 0;
                if (d)return this;
                for (d = !0; f > c; c++)q.tweens[c].run(1);
                return p ? h.resolveWith(b, [q, p]) : h.rejectWith(b, [q, p]), this
            }
        });
        c = q.props;
        for (O(c, q.opts.specialEasing); l > e; e++)if (p = Ja[e].call(q, b, c, q.opts))return p;
        return f.map(c, v, q), f.isFunction(q.opts.start) && q.opts.start.call(b, q), f.fx.timer(f.extend(g, {
            elem: b,
            anim: q,
            queue: q.opts.queue
        })), q.progress(q.opts.progress).done(q.opts.done,
            q.opts.complete).fail(q.opts.fail).always(q.opts.always)
    }

    function J(b) {
        return function (p, c) {
            "string" != typeof p && (c = p, p = "*");
            var d, e = 0, l = p.toLowerCase().match(W) || [];
            if (f.isFunction(c))for (; d = l[e++];)"+" === d[0] ? (d = d.slice(1) || "*", (b[d] = b[d] || []).unshift(c)) : (b[d] = b[d] || []).push(c)
        }
    }

    function da(b, p, c, d) {
        function e(g) {
            var q;
            return l[g] = !0, f.each(b[g] || [], function (b, m) {
                var f = m(p, c, d);
                return "string" != typeof f || h || l[f] ? h ? !(q = f) : void 0 : (p.dataTypes.unshift(f), e(f), !1)
            }), q
        }

        var l = {}, h = b === Ra;
        return e(p.dataTypes[0]) ||
            !l["*"] && e("*")
    }

    function wa(b, p) {
        var c, d, e = f.ajaxSettings.flatOptions || {};
        for (c in p)void 0 !== p[c] && ((e[c] ? b : d || (d = {}))[c] = p[c]);
        return d && f.extend(!0, b, d), b
    }

    function ia(b, p, c, d) {
        var e;
        if (f.isArray(p)) f.each(p, function (p, f) {
            c || ub.test(b) ? d(b, f) : ia(b + "[" + ("object" == typeof f ? p : "") + "]", f, c, d)
        }); else if (c || "object" !== f.type(p)) d(b, p); else for (e in p)ia(b + "[" + e + "]", p[e], c, d)
    }

    function Ca(b) {
        return f.isWindow(b) ? b : 9 === b.nodeType && b.defaultView
    }

    var na = [], ja = na.slice, la = na.concat, M = na.push, S = na.indexOf, Q =
        {}, Ea = Q.toString, oa = Q.hasOwnProperty, N = {}, K = d.document, f = function (b, p) {
        return new f.fn.init(b, p)
    }, Aa = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, pa = /^-ms-/, Ka = /-([\da-z])/gi, La = function (b, p) {
        return p.toUpperCase()
    };
    f.fn = f.prototype = {
        jquery: "2.1.1", constructor: f, selector: "", length: 0, toArray: function () {
            return ja.call(this)
        }, get: function (b) {
            return null != b ? 0 > b ? this[b + this.length] : this[b] : ja.call(this)
        }, pushStack: function (b) {
            b = f.merge(this.constructor(), b);
            return b.prevObject = this, b.context = this.context, b
        }, each: function (b,
                           p) {
            return f.each(this, b, p)
        }, map: function (b) {
            return this.pushStack(f.map(this, function (p, c) {
                return b.call(p, c, p)
            }))
        }, slice: function () {
            return this.pushStack(ja.apply(this, arguments))
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, eq: function (b) {
            var p = this.length;
            b = +b + (0 > b ? p : 0);
            return this.pushStack(0 <= b && p > b ? [this[b]] : [])
        }, end: function () {
            return this.prevObject || this.constructor(null)
        }, push: M, sort: na.sort, splice: na.splice
    };
    f.extend = f.fn.extend = function () {
        var b, p, c, d, e, l, h = arguments[0] ||
            {}, g = 1, q = arguments.length, u = !1;
        "boolean" == typeof h && (u = h, h = arguments[g] || {}, g++);
        "object" == typeof h || f.isFunction(h) || (h = {});
        for (g === q && (h = this, g--); q > g; g++)if (null != (b = arguments[g]))for (p in b)c = h[p], d = b[p], h !== d && (u && d && (f.isPlainObject(d) || (e = f.isArray(d))) ? (e ? (e = !1, l = c && f.isArray(c) ? c : []) : l = c && f.isPlainObject(c) ? c : {}, h[p] = f.extend(u, l, d)) : void 0 !== d && (h[p] = d));
        return h
    };
    f.extend({
        expando: "jQuery" + ("2.1.1" + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (b) {
            throw Error(b);
        }, noop: function () {
        },
        isFunction: function (b) {
            return "function" === f.type(b)
        }, isArray: Array.isArray, isWindow: function (b) {
            return null != b && b === b.window
        }, isNumeric: function (b) {
            return !f.isArray(b) && 0 <= b - parseFloat(b)
        }, isPlainObject: function (b) {
            return "object" !== f.type(b) || b.nodeType || f.isWindow(b) ? !1 : b.constructor && !oa.call(b.constructor.prototype, "isPrototypeOf") ? !1 : !0
        }, isEmptyObject: function (b) {
            for (var p in b)return !1;
            return !0
        }, type: function (b) {
            return null == b ? b + "" : "object" == typeof b || "function" == typeof b ? Q[Ea.call(b)] || "object" :
                typeof b
        }, globalEval: function (b) {
            var p, c = eval;
            (b = f.trim(b)) && (1 === b.indexOf("use strict") ? (p = K.createElement("script"), p.text = b, K.head.appendChild(p).parentNode.removeChild(p)) : c(b))
        }, camelCase: function (b) {
            return b.replace(pa, "ms-").replace(Ka, La)
        }, nodeName: function (b, p) {
            return b.nodeName && b.nodeName.toLowerCase() === p.toLowerCase()
        }, each: function (b, p, c) {
            var d, f = 0, e = b.length, h = t(b);
            if (c)if (h)for (; e > f && (d = p.apply(b[f], c), !1 !== d); f++); else for (f in b) {
                if (d = p.apply(b[f], c), !1 === d)break
            } else if (h)for (; e >
                                f && (d = p.call(b[f], f, b[f]), !1 !== d); f++); else for (f in b)if (d = p.call(b[f], f, b[f]), !1 === d)break;
            return b
        }, trim: function (b) {
            return null == b ? "" : (b + "").replace(Aa, "")
        }, makeArray: function (b, p) {
            var c = p || [];
            return null != b && (t(Object(b)) ? f.merge(c, "string" == typeof b ? [b] : b) : M.call(c, b)), c
        }, inArray: function (b, p, c) {
            return null == p ? -1 : S.call(p, b, c)
        }, merge: function (b, p) {
            for (var c = +p.length, f = 0, d = b.length; c > f; f++)b[d++] = p[f];
            return b.length = d, b
        }, grep: function (b, p, c) {
            for (var f = [], d = 0, e = b.length, h = !c; e > d; d++)c = !p(b[d],
                d), c !== h && f.push(b[d]);
            return f
        }, map: function (b, p, c) {
            var f, d = 0, e = b.length, h = [];
            if (t(b))for (; e > d; d++)f = p(b[d], d, c), null != f && h.push(f); else for (d in b)f = p(b[d], d, c), null != f && h.push(f);
            return la.apply([], h)
        }, guid: 1, proxy: function (b, p) {
            var c, d, e;
            return "string" == typeof p && (c = b[p], p = b, b = c), f.isFunction(b) ? (d = ja.call(arguments, 2), e = function () {
                return b.apply(p || this, d.concat(ja.call(arguments)))
            }, e.guid = b.guid = b.guid || f.guid++, e) : void 0
        }, now: Date.now, support: N
    });
    f.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),
        function (b, c) {
            Q["[object " + c + "]"] = c.toLowerCase()
        });
    var Y = function (b) {
        function c(b, m, p, f) {
            var d, e, A, y, h;
            if ((m ? m.ownerDocument || m : D) !== R && L(m), m = m || R, p = p || [], !b || "string" != typeof b)return p;
            if (1 !== (y = m.nodeType) && 9 !== y)return [];
            if (da && !f) {
                if (d = ta.exec(b))if (A = d[1])if (9 === y) {
                    if (e = m.getElementById(A), !e || !e.parentNode)return p;
                    if (e.id === A)return p.push(e), p
                } else {
                    if (m.ownerDocument && (e = m.ownerDocument.getElementById(A)) && H(m, e) && e.id === A)return p.push(e), p
                } else {
                    if (d[2])return qa.apply(p, m.getElementsByTagName(b)),
                        p;
                    if ((A = d[3]) && I.getElementsByClassName && m.getElementsByClassName)return qa.apply(p, m.getElementsByClassName(A)), p
                }
                if (I.qsa && (!z || !z.test(b))) {
                    if (e = d = Q, A = m, h = 9 === y && b, 1 === y && "object" !== m.nodeName.toLowerCase()) {
                        y = S(b);
                        (d = m.getAttribute("id")) ? e = d.replace(va, "\\$&") : m.setAttribute("id", e);
                        e = "[id='" + e + "'] ";
                        for (A = y.length; A--;)y[A] = e + r(y[A]);
                        A = ma.test(b) && k(m.parentNode) || m;
                        h = y.join(",")
                    }
                    if (h)try {
                        return qa.apply(p, A.querySelectorAll(h)), p
                    } catch (l) {
                    } finally {
                        d || m.removeAttribute("id")
                    }
                }
            }
            return fa(b.replace(Y,
                "$1"), m, p, f)
        }

        function d() {
            function b(c, p) {
                return m.push(c + " ") > B.cacheLength && delete b[m.shift()], b[c + " "] = p
            }

            var m = [];
            return b
        }

        function f(b) {
            return b[Q] = !0, b
        }

        function e(b) {
            var m = R.createElement("div");
            try {
                return !!b(m)
            } catch (c) {
                return !1
            } finally {
                m.parentNode && m.parentNode.removeChild(m)
            }
        }

        function h(b, m) {
            for (var c = b.split("|"), p = b.length; p--;)B.attrHandle[c[p]] = m
        }

        function l(b, m) {
            var c = m && b,
                p = c && 1 === b.nodeType && 1 === m.nodeType && (~m.sourceIndex || -2147483648) - (~b.sourceIndex || -2147483648);
            if (p)return p;
            if (c)for (; c = c.nextSibling;)if (c === m)return -1;
            return b ? 1 : -1
        }

        function g(b) {
            return function (m) {
                return "input" === m.nodeName.toLowerCase() && m.type === b
            }
        }

        function q(b) {
            return function (m) {
                var c = m.nodeName.toLowerCase();
                return ("input" === c || "button" === c) && m.type === b
            }
        }

        function u(b) {
            return f(function (m) {
                return m = +m, f(function (c, p) {
                    for (var f, d = b([], c.length, m), e = d.length; e--;)c[f = d[e]] && (c[f] = !(p[f] = c[f]))
                })
            })
        }

        function k(b) {
            return b && "undefined" !== typeof b.getElementsByTagName && b
        }

        function v() {
        }

        function r(b) {
            for (var m =
                0, c = b.length, p = ""; c > m; m++)p += b[m].value;
            return p
        }

        function E(b, m, c) {
            var p = m.dir, f = c && "parentNode" === p, d = Sa++;
            return m.first ? function (m, c, d) {
                for (; m = m[p];)if (1 === m.nodeType || f)return b(m, c, d)
            } : function (m, c, e) {
                var A, y, h = [W, d];
                if (e)for (; m = m[p];) {
                    if ((1 === m.nodeType || f) && b(m, c, e))return !0
                } else for (; m = m[p];)if (1 === m.nodeType || f) {
                    if (y = m[Q] || (m[Q] = {}), (A = y[p]) && A[0] === W && A[1] === d)return h[2] = A[2];
                    if (y[p] = h, h[2] = b(m, c, e))return !0
                }
            }
        }

        function n(b) {
            return 1 < b.length ? function (m, c, p) {
                for (var f = b.length; f--;)if (!b[f](m,
                        c, p))return !1;
                return !0
            } : b[0]
        }

        function O(b, m, c, p, f) {
            for (var d, e = [], A = 0, y = b.length, h = null != m; y > A; A++)(d = b[A]) && (!c || c(d, p, f)) && (e.push(d), h && m.push(A));
            return e
        }

        function M(b, m, d, e, A, h) {
            return e && !e[Q] && (e = M(e)), A && !A[Q] && (A = M(A, h)), f(function (f, y, h, l) {
                var g, X, q = [], ba = [], u = y.length, k;
                if (!(k = f)) {
                    k = m || "*";
                    for (var U = h.nodeType ? [h] : h, v = [], r = 0, E = U.length; E > r; r++)c(k, U[r], v);
                    k = v
                }
                k = !b || !f && m ? k : O(k, q, b, h, l);
                U = d ? A || (f ? b : u || e) ? [] : y : k;
                if (d && d(k, U, h, l), e)for (g = O(U, ba), e(g, [], h, l), h = g.length; h--;)(X = g[h]) && (U[ba[h]] =
                    !(k[ba[h]] = X));
                if (f) {
                    if (A || b) {
                        if (A) {
                            g = [];
                            for (h = U.length; h--;)(X = U[h]) && g.push(k[h] = X);
                            A(null, U = [], g, l)
                        }
                        for (h = U.length; h--;)(X = U[h]) && -1 < (g = A ? la.call(f, X) : q[h]) && (f[g] = !(y[g] = X))
                    }
                } else U = O(U === y ? U.splice(u, U.length) : U), A ? A(null, y, U, l) : qa.apply(y, U)
            })
        }

        function x(b) {
            var m, c, p, f = b.length, d = B.relative[b[0].type];
            c = d || B.relative[" "];
            for (var e = d ? 1 : 0, A = E(function (b) {
                return b === m
            }, c, !0), y = E(function (b) {
                return -1 < la.call(m, b)
            }, c, !0), h = [function (b, c, p) {
                return !d && (p || c !== F) || ((m = c).nodeType ? A(b, c, p) : y(b, c, p))
            }]; f >
                 e; e++)if (c = B.relative[b[e].type]) h = [E(n(h), c)]; else {
                if (c = B.filter[b[e].type].apply(null, b[e].matches), c[Q]) {
                    for (p = ++e; f > p && !B.relative[b[p].type]; p++);
                    return M(1 < e && n(h), 1 < e && r(b.slice(0, e - 1).concat({value: " " === b[e - 2].type ? "*" : ""})).replace(Y, "$1"), c, p > e && x(b.slice(e, p)), f > p && x(b = b.slice(p)), f > p && r(b))
                }
                h.push(c)
            }
            return n(h)
        }

        function s(b, m) {
            var d = 0 < m.length, e = 0 < b.length, A = function (f, A, y, h, l) {
                var g, X, q, ba = 0, u = "0", U = f && [], k = [], v = F, r = f || e && B.find.TAG("*", l),
                    E = W += null == v ? 1 : Math.random() || .1, n = r.length;
                for (l && (F = A !== R && A); u !== n && null != (g = r[u]); u++) {
                    if (e && g) {
                        for (X = 0; q = b[X++];)if (q(g, A, y)) {
                            h.push(g);
                            break
                        }
                        l && (W = E)
                    }
                    d && ((g = !q && g) && ba--, f && U.push(g))
                }
                if (ba += u, d && u !== ba) {
                    for (X = 0; q = m[X++];)q(U, k, A, y);
                    if (f) {
                        if (0 < ba)for (; u--;)U[u] || k[u] || (k[u] = Ea.call(h));
                        k = O(k)
                    }
                    qa.apply(h, k);
                    l && !f && 0 < k.length && 1 < ba + m.length && c.uniqueSort(h)
                }
                return l && (W = E, F = v), U
            };
            return d ? f(A) : A
        }

        var w, I, B, J, aa, S, G, fa, F, V, t, L, R, C, da, z, ia, K, H, Q = "sizzle" + -new Date, D = b.document,
            W = 0, Sa = 0, N = d(), wa = d(), ka = d(), oa = function (b, m) {
                return b === m && (t =
                    !0), 0
            }, za = {}.hasOwnProperty, P = [], Ea = P.pop, ga = P.push, qa = P.push, T = P.slice,
            la = P.indexOf || function (b) {
                    for (var m = 0, c = this.length; c > m; m++)if (this[m] === b)return m;
                    return -1
                }, ja = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+".replace("w", "w#"),
            Z = "\\[[\\x20\\t\\r\\n\\f]*((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)(?:[\\x20\\t\\r\\n\\f]*([*^$|!~]?=)[\\x20\\t\\r\\n\\f]*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + ja + "))|)[\\x20\\t\\r\\n\\f]*\\]",
            Aa = ":((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" +
                Z + ")*)|.*)\\)|)",
            Y = RegExp("^[\\x20\\t\\r\\n\\f]+|((?:^|[^\\\\])(?:\\\\.)*)[\\x20\\t\\r\\n\\f]+$", "g"),
            ca = /^[\x20\t\r\n\f]*,[\x20\t\r\n\f]*/, Ca = /^[\x20\t\r\n\f]*([>+~]|[\x20\t\r\n\f])[\x20\t\r\n\f]*/,
            na = RegExp("=[\\x20\\t\\r\\n\\f]*([^\\]'\"]*?)[\\x20\\t\\r\\n\\f]*\\]", "g"), ea = new RegExp(Aa),
            ha = new RegExp("^" + ja + "$"), pa = {
                ID: /^#((?:\\.|[\w-]|[^\x00-\xa0])+)/,
                CLASS: /^\.((?:\\.|[\w-]|[^\x00-\xa0])+)/,
                TAG: new RegExp("^(" + "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+".replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + Z),
                PSEUDO: new RegExp("^" + Aa),
                CHILD: /^:(only|first|last|nth|nth-last)-(child|of-type)(?:\([\x20\t\r\n\f]*(even|odd|(([+-]|)(\d*)n|)[\x20\t\r\n\f]*(?:([+-]|)[\x20\t\r\n\f]*(\d+)|))[\x20\t\r\n\f]*\)|)/i,
                bool: /^(?:checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)$/i,
                needsContext: /^[\x20\t\r\n\f]*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\([\x20\t\r\n\f]*((?:-\d)?\d*)[\x20\t\r\n\f]*\)|)(?=[^-]|$)/i
            }, ra = /^(?:input|select|textarea|button)$/i,
            sa = /^h\d$/i, ua = /^[^{]+\{\s*\[native \w/, ta = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ma = /[+~]/,
            va = /'|\\/g, xa = RegExp("\\\\([\\da-f]{1,6}[\\x20\\t\\r\\n\\f]?|([\\x20\\t\\r\\n\\f])|.)", "ig"),
            ya = function (b, m, c) {
                b = "0x" + m - 65536;
                return b !== b || c ? m : 0 > b ? String.fromCharCode(b + 65536) : String.fromCharCode(b >> 10 | 55296, 1023 & b | 56320)
            };
        try {
            qa.apply(P = T.call(D.childNodes), D.childNodes), P[D.childNodes.length].nodeType
        } catch (Ba) {
            qa = {
                apply: P.length ? function (b, m) {
                    ga.apply(b, T.call(m))
                } : function (b, m) {
                    for (var c = b.length, p = 0; b[c++] =
                        m[p++];);
                    b.length = c - 1
                }
            }
        }
        I = c.support = {};
        aa = c.isXML = function (b) {
            return (b = b && (b.ownerDocument || b).documentElement) ? "HTML" !== b.nodeName : !1
        };
        L = c.setDocument = function (b) {
            var m, c = b ? b.ownerDocument || b : D;
            b = c.defaultView;
            return c !== R && 9 === c.nodeType && c.documentElement ? (R = c, C = c.documentElement, da = !aa(c), b && b !== b.top && (b.addEventListener ? b.addEventListener("unload", function () {
                L()
            }, !1) : b.attachEvent && b.attachEvent("onunload", function () {
                    L()
                })), I.attributes = e(function (b) {
                return b.className = "i", !b.getAttribute("className")
            }),
                I.getElementsByTagName = e(function (b) {
                    return b.appendChild(c.createComment("")), !b.getElementsByTagName("*").length
                }), I.getElementsByClassName = ua.test(c.getElementsByClassName) && e(function (b) {
                    return b.innerHTML = "<div class='a'></div><div class='a i'></div>", b.firstChild.className = "i", 2 === b.getElementsByClassName("i").length
                }), I.getById = e(function (b) {
                return C.appendChild(b).id = Q, !c.getElementsByName || !c.getElementsByName(Q).length
            }), I.getById ? (B.find.ID = function (b, m) {
                if ("undefined" !== typeof m.getElementById &&
                    da) {
                    var c = m.getElementById(b);
                    return c && c.parentNode ? [c] : []
                }
            }, B.filter.ID = function (b) {
                var m = b.replace(xa, ya);
                return function (b) {
                    return b.getAttribute("id") === m
                }
            }) : (delete B.find.ID, B.filter.ID = function (b) {
                var m = b.replace(xa, ya);
                return function (b) {
                    return (b = "undefined" !== typeof b.getAttributeNode && b.getAttributeNode("id")) && b.value === m
                }
            }), B.find.TAG = I.getElementsByTagName ? function (b, m) {
                return "undefined" !== typeof m.getElementsByTagName ? m.getElementsByTagName(b) : void 0
            } : function (b, m) {
                var c, p = [], f = 0, d =
                    m.getElementsByTagName(b);
                if ("*" === b) {
                    for (; c = d[f++];)1 === c.nodeType && p.push(c);
                    return p
                }
                return d
            }, B.find.CLASS = I.getElementsByClassName && function (b, m) {
                    return "undefined" !== typeof m.getElementsByClassName && da ? m.getElementsByClassName(b) : void 0
                }, ia = [], z = [], (I.qsa = ua.test(c.querySelectorAll)) && (e(function (b) {
                b.innerHTML = "<select msallowclip=''><option selected=''></option></select>";
                b.querySelectorAll("[msallowclip^='']").length && z.push("[*^$]=[\\x20\\t\\r\\n\\f]*(?:''|\"\")");
                b.querySelectorAll("[selected]").length ||
                z.push("\\[[\\x20\\t\\r\\n\\f]*(?:value|checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)");
                b.querySelectorAll(":checked").length || z.push(":checked")
            }), e(function (b) {
                var m = c.createElement("input");
                m.setAttribute("type", "hidden");
                b.appendChild(m).setAttribute("name", "D");
                b.querySelectorAll("[name=d]").length && z.push("name[\\x20\\t\\r\\n\\f]*[*^$|!~]?=");
                b.querySelectorAll(":enabled").length || z.push(":enabled", ":disabled");
                b.querySelectorAll("*,:x");
                z.push(",.*:")
            })), (I.matchesSelector = ua.test(K = C.matches || C.webkitMatchesSelector || C.mozMatchesSelector || C.oMatchesSelector || C.msMatchesSelector)) && e(function (b) {
                I.disconnectedMatch = K.call(b, "div");
                K.call(b, "[s!='']:x");
                ia.push("!=", Aa)
            }), z = z.length && new RegExp(z.join("|")), ia = ia.length && new RegExp(ia.join("|")), m = ua.test(C.compareDocumentPosition), H = m || ua.test(C.contains) ? function (b, m) {
                var c = 9 === b.nodeType ? b.documentElement : b, p = m && m.parentNode;
                return b === p || !(!p || 1 !== p.nodeType || !(c.contains ? c.contains(p) :
                        b.compareDocumentPosition && 16 & b.compareDocumentPosition(p)))
            } : function (b, m) {
                if (m)for (; m = m.parentNode;)if (m === b)return !0;
                return !1
            }, oa = m ? function (b, m) {
                if (b === m)return t = !0, 0;
                var p = !b.compareDocumentPosition - !m.compareDocumentPosition;
                return p ? p : (p = (b.ownerDocument || b) === (m.ownerDocument || m) ? b.compareDocumentPosition(m) : 1, 1 & p || !I.sortDetached && m.compareDocumentPosition(b) === p ? b === c || b.ownerDocument === D && H(D, b) ? -1 : m === c || m.ownerDocument === D && H(D, m) ? 1 : V ? la.call(V, b) - la.call(V, m) : 0 : 4 & p ? -1 : 1)
            } : function (b,
                          m) {
                if (b === m)return t = !0, 0;
                var p, f = 0;
                p = b.parentNode;
                var d = m.parentNode, e = [b], A = [m];
                if (!p || !d)return b === c ? -1 : m === c ? 1 : p ? -1 : d ? 1 : V ? la.call(V, b) - la.call(V, m) : 0;
                if (p === d)return l(b, m);
                for (p = b; p = p.parentNode;)e.unshift(p);
                for (p = m; p = p.parentNode;)A.unshift(p);
                for (; e[f] === A[f];)f++;
                return f ? l(e[f], A[f]) : e[f] === D ? -1 : A[f] === D ? 1 : 0
            }, c) : R
        };
        c.matches = function (b, m) {
            return c(b, null, null, m)
        };
        c.matchesSelector = function (b, m) {
            if ((b.ownerDocument || b) !== R && L(b), m = m.replace(na, "='$1']"), !(!I.matchesSelector || !da || ia && ia.test(m) ||
                z && z.test(m)))try {
                var f = K.call(b, m);
                if (f || I.disconnectedMatch || b.document && 11 !== b.document.nodeType)return f
            } catch (d) {
            }
            return 0 < c(m, R, null, [b]).length
        };
        c.contains = function (b, m) {
            return (b.ownerDocument || b) !== R && L(b), H(b, m)
        };
        c.attr = function (b, m) {
            (b.ownerDocument || b) !== R && L(b);
            var c = B.attrHandle[m.toLowerCase()],
                c = c && za.call(B.attrHandle, m.toLowerCase()) ? c(b, m, !da) : void 0;
            return void 0 !== c ? c : I.attributes || !da ? b.getAttribute(m) : (c = b.getAttributeNode(m)) && c.specified ? c.value : null
        };
        c.error = function (b) {
            throw Error("Syntax error, unrecognized expression: " +
                b);
        };
        c.uniqueSort = function (b) {
            var m, c = [], p = 0, f = 0;
            if (t = !I.detectDuplicates, V = !I.sortStable && b.slice(0), b.sort(oa), t) {
                for (; m = b[f++];)m === b[f] && (p = c.push(f));
                for (; p--;)b.splice(c[p], 1)
            }
            return V = null, b
        };
        J = c.getText = function (b) {
            var m, c = "", p = 0;
            if (m = b.nodeType)if (1 === m || 9 === m || 11 === m) {
                if ("string" == typeof b.textContent)return b.textContent;
                for (b = b.firstChild; b; b = b.nextSibling)c += J(b)
            } else {
                if (3 === m || 4 === m)return b.nodeValue
            } else for (; m = b[p++];)c += J(m);
            return c
        };
        B = c.selectors = {
            cacheLength: 50,
            createPseudo: f,
            match: pa,
            attrHandle: {},
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (b) {
                    return b[1] = b[1].replace(xa, ya), b[3] = (b[3] || b[4] || b[5] || "").replace(xa, ya), "~=" === b[2] && (b[3] = " " + b[3] + " "), b.slice(0, 4)
                }, CHILD: function (b) {
                    return b[1] = b[1].toLowerCase(), "nth" === b[1].slice(0, 3) ? (b[3] || c.error(b[0]), b[4] = +(b[4] ? b[5] + (b[6] || 1) : 2 * ("even" === b[3] || "odd" === b[3])), b[5] = +(b[7] + b[8] || "odd" === b[3])) : b[3] &&
                        c.error(b[0]), b
                }, PSEUDO: function (b) {
                    var m, c = !b[6] && b[2];
                    return pa.CHILD.test(b[0]) ? null : (b[3] ? b[2] = b[4] || b[5] || "" : c && ea.test(c) && (m = S(c, !0)) && (m = c.indexOf(")", c.length - m) - c.length) && (b[0] = b[0].slice(0, m), b[2] = c.slice(0, m)), b.slice(0, 3))
                }
            },
            filter: {
                TAG: function (b) {
                    var m = b.replace(xa, ya).toLowerCase();
                    return "*" === b ? function () {
                        return !0
                    } : function (b) {
                        return b.nodeName && b.nodeName.toLowerCase() === m
                    }
                }, CLASS: function (b) {
                    var m = N[b + " "];
                    return m || (m = new RegExp("(^|[\\x20\\t\\r\\n\\f])" + b + "([\\x20\\t\\r\\n\\f]|$)")) &&
                        N(b, function (b) {
                            return m.test("string" == typeof b.className && b.className || "undefined" !== typeof b.getAttribute && b.getAttribute("class") || "")
                        })
                }, ATTR: function (b, m, f) {
                    return function (d) {
                        d = c.attr(d, b);
                        return null == d ? "!=" === m : m ? (d += "", "=" === m ? d === f : "!=" === m ? d !== f : "^=" === m ? f && 0 === d.indexOf(f) : "*=" === m ? f && -1 < d.indexOf(f) : "$=" === m ? f && d.slice(-f.length) === f : "~=" === m ? -1 < (" " + d + " ").indexOf(f) : "|=" === m ? d === f || d.slice(0, f.length + 1) === f + "-" : !1) : !0
                    }
                }, CHILD: function (b, m, c, p, f) {
                    var d = "nth" !== b.slice(0, 3), e = "last" !==
                        b.slice(-4), A = "of-type" === m;
                    return 1 === p && 0 === f ? function (b) {
                        return !!b.parentNode
                    } : function (m, c, y) {
                        var h, l, g, X, q;
                        c = d !== e ? "nextSibling" : "previousSibling";
                        var ba = m.parentNode, u = A && m.nodeName.toLowerCase();
                        y = !y && !A;
                        if (ba) {
                            if (d) {
                                for (; c;) {
                                    for (l = m; l = l[c];)if (A ? l.nodeName.toLowerCase() === u : 1 === l.nodeType)return !1;
                                    q = c = "only" === b && !q && "nextSibling"
                                }
                                return !0
                            }
                            if (q = [e ? ba.firstChild : ba.lastChild], e && y)for (y = ba[Q] || (ba[Q] = {}), h = y[b] || [], X = h[0] === W && h[1], g = h[0] === W && h[2], l = X && ba.childNodes[X]; l = ++X && l && l[c] || (g =
                                    X = 0) || q.pop();) {
                                if (1 === l.nodeType && ++g && l === m) {
                                    y[b] = [W, X, g];
                                    break
                                }
                            } else if (y && (h = (m[Q] || (m[Q] = {}))[b]) && h[0] === W) g = h[1]; else for (; (l = ++X && l && l[c] || (g = X = 0) || q.pop()) && ((A ? l.nodeName.toLowerCase() !== u : 1 !== l.nodeType) || !++g || (y && ((l[Q] || (l[Q] = {}))[b] = [W, g]), l !== m)););
                            return g -= f, g === p || 0 === g % p && 0 <= g / p
                        }
                    }
                }, PSEUDO: function (b, m) {
                    var d, e = B.pseudos[b] || B.setFilters[b.toLowerCase()] || c.error("unsupported pseudo: " + b);
                    return e[Q] ? e(m) : 1 < e.length ? (d = [b, b, "", m], B.setFilters.hasOwnProperty(b.toLowerCase()) ? f(function (b,
                                                                                                                                       c) {
                        for (var p, f = e(b, m), d = f.length; d--;)p = la.call(b, f[d]), b[p] = !(c[p] = f[d])
                    }) : function (b) {
                        return e(b, 0, d)
                    }) : e
                }
            },
            pseudos: {
                not: f(function (b) {
                    var m = [], c = [], p = G(b.replace(Y, "$1"));
                    return p[Q] ? f(function (b, m, c, f) {
                        var d;
                        c = p(b, null, f, []);
                        for (f = b.length; f--;)(d = c[f]) && (b[f] = !(m[f] = d))
                    }) : function (b, f, d) {
                        return m[0] = b, p(m, null, d, c), !c.pop()
                    }
                }), has: f(function (b) {
                    return function (m) {
                        return 0 < c(b, m).length
                    }
                }), contains: f(function (b) {
                    return function (m) {
                        return -1 < (m.textContent || m.innerText || J(m)).indexOf(b)
                    }
                }), lang: f(function (b) {
                    return ha.test(b ||
                        "") || c.error("unsupported lang: " + b), b = b.replace(xa, ya).toLowerCase(), function (m) {
                        var c;
                        do if (c = da ? m.lang : m.getAttribute("xml:lang") || m.getAttribute("lang"))return c = c.toLowerCase(), c === b || 0 === c.indexOf(b + "-"); while ((m = m.parentNode) && 1 === m.nodeType);
                        return !1
                    }
                }), target: function (c) {
                    var p = b.location && b.location.hash;
                    return p && p.slice(1) === c.id
                }, root: function (b) {
                    return b === C
                }, focus: function (b) {
                    return b === R.activeElement && (!R.hasFocus || R.hasFocus()) && !!(b.type || b.href || ~b.tabIndex)
                }, enabled: function (b) {
                    return !1 ===
                        b.disabled
                }, disabled: function (b) {
                    return !0 === b.disabled
                }, checked: function (b) {
                    var m = b.nodeName.toLowerCase();
                    return "input" === m && !!b.checked || "option" === m && !!b.selected
                }, selected: function (b) {
                    return b.parentNode && b.parentNode.selectedIndex, !0 === b.selected
                }, empty: function (b) {
                    for (b = b.firstChild; b; b = b.nextSibling)if (6 > b.nodeType)return !1;
                    return !0
                }, parent: function (b) {
                    return !B.pseudos.empty(b)
                }, header: function (b) {
                    return sa.test(b.nodeName)
                }, input: function (b) {
                    return ra.test(b.nodeName)
                }, button: function (b) {
                    var m =
                        b.nodeName.toLowerCase();
                    return "input" === m && "button" === b.type || "button" === m
                }, text: function (b) {
                    var m;
                    return "input" === b.nodeName.toLowerCase() && "text" === b.type && (null == (m = b.getAttribute("type")) || "text" === m.toLowerCase())
                }, first: u(function () {
                    return [0]
                }), last: u(function (b, m) {
                    return [m - 1]
                }), eq: u(function (b, m, c) {
                    return [0 > c ? c + m : c]
                }), even: u(function (b, m) {
                    for (var c = 0; m > c; c += 2)b.push(c);
                    return b
                }), odd: u(function (b, m) {
                    for (var c = 1; m > c; c += 2)b.push(c);
                    return b
                }), lt: u(function (b, m, c) {
                    for (m = 0 > c ? c + m : c; 0 <= --m;)b.push(m);
                    return b
                }), gt: u(function (b, m, c) {
                    for (c = 0 > c ? c + m : c; ++c < m;)b.push(c);
                    return b
                })
            }
        };
        B.pseudos.nth = B.pseudos.eq;
        for (w in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})B.pseudos[w] = g(w);
        for (w in{submit: !0, reset: !0})B.pseudos[w] = q(w);
        v.prototype = B.filters = B.pseudos;
        B.setFilters = new v;
        S = c.tokenize = function (b, m) {
            var f, d, e, A, y, h, l;
            if (y = wa[b + " "])return m ? 0 : y.slice(0);
            y = b;
            h = [];
            for (l = B.preFilter; y;) {
                f && !(d = ca.exec(y)) || (d && (y = y.slice(d[0].length) || y), h.push(e = []));
                f = !1;
                (d = Ca.exec(y)) && (f = d.shift(), e.push({
                    value: f,
                    type: d[0].replace(Y, " ")
                }), y = y.slice(f.length));
                for (A in B.filter)!(d = pa[A].exec(y)) || l[A] && !(d = l[A](d)) || (f = d.shift(), e.push({
                    value: f,
                    type: A,
                    matches: d
                }), y = y.slice(f.length));
                if (!f)break
            }
            return m ? y.length : y ? c.error(b) : wa(b, h).slice(0)
        };
        return G = c.compile = function (b, m) {
            var c, p = [], f = [], d = ka[b + " "];
            if (!d) {
                m || (m = S(b));
                for (c = m.length; c--;)d = x(m[c]), d[Q] ? p.push(d) : f.push(d);
                d = ka(b, s(f, p));
                d.selector = b
            }
            return d
        }, fa = c.select = function (b, m, c, p) {
            var f, d, e, A, y, h = "function" == typeof b && b, l = !p && S(b = h.selector ||
                    b);
            if (c = c || [], 1 === l.length) {
                if (d = l[0] = l[0].slice(0), 2 < d.length && "ID" === (e = d[0]).type && I.getById && 9 === m.nodeType && da && B.relative[d[1].type]) {
                    if (m = (B.find.ID(e.matches[0].replace(xa, ya), m) || [])[0], !m)return c;
                    h && (m = m.parentNode);
                    b = b.slice(d.shift().value.length)
                }
                for (f = pa.needsContext.test(b) ? 0 : d.length; f-- && (e = d[f], !B.relative[A = e.type]);)if ((y = B.find[A]) && (p = y(e.matches[0].replace(xa, ya), ma.test(d[0].type) && k(m.parentNode) || m))) {
                    if (d.splice(f, 1), b = p.length && r(d), !b)return qa.apply(c, p), c;
                    break
                }
            }
            return (h ||
            G(b, l))(p, m, !da, c, ma.test(b) && k(m.parentNode) || m), c
        }, I.sortStable = Q.split("").sort(oa).join("") === Q, I.detectDuplicates = !!t, L(), I.sortDetached = e(function (b) {
            return 1 & b.compareDocumentPosition(R.createElement("div"))
        }), e(function (b) {
            return b.innerHTML = "<a href='#'></a>", "#" === b.firstChild.getAttribute("href")
        }) || h("type|href|height|width", function (b, m, c) {
            return c ? void 0 : b.getAttribute(m, "type" === m.toLowerCase() ? 1 : 2)
        }), I.attributes && e(function (b) {
            return b.innerHTML = "<input/>", b.firstChild.setAttribute("value",
                ""), "" === b.firstChild.getAttribute("value")
        }) || h("value", function (b, m, c) {
            return c || "input" !== b.nodeName.toLowerCase() ? void 0 : b.defaultValue
        }), e(function (b) {
            return null == b.getAttribute("disabled")
        }) || h("checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", function (b, m, c) {
            var p;
            return c ? void 0 : !0 === b[m] ? m.toLowerCase() : (p = b.getAttributeNode(m)) && p.specified ? p.value : null
        }), c
    }(d);
    f.find = Y;
    f.expr = Y.selectors;
    f.expr[":"] = f.expr.pseudos;
    f.unique = Y.uniqueSort;
    f.text = Y.getText;
    f.isXMLDoc = Y.isXML;
    f.contains = Y.contains;
    var h = f.expr.match.needsContext, u = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, E = /^.[^:#\[\.,]*$/;
    f.filter = function (b, c, d) {
        var e = c[0];
        return d && (b = ":not(" + b + ")"), 1 === c.length && 1 === e.nodeType ? f.find.matchesSelector(e, b) ? [e] : [] : f.find.matches(b, f.grep(c, function (b) {
            return 1 === b.nodeType
        }))
    };
    f.fn.extend({
        find: function (b) {
            var c, d = this.length, e = [], h = this;
            if ("string" != typeof b)return this.pushStack(f(b).filter(function () {
                for (c = 0; d > c; c++)if (f.contains(h[c],
                        this))return !0
            }));
            for (c = 0; d > c; c++)f.find(b, h[c], e);
            return e = this.pushStack(1 < d ? f.unique(e) : e), e.selector = this.selector ? this.selector + " " + b : b, e
        }, filter: function (b) {
            return this.pushStack(c(this, b || [], !1))
        }, not: function (b) {
            return this.pushStack(c(this, b || [], !0))
        }, is: function (b) {
            return !!c(this, "string" == typeof b && h.test(b) ? f(b) : b || [], !1).length
        }
    });
    var fa, R = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;
    (f.fn.init = function (b, c) {
        var d, e;
        if (!b)return this;
        if ("string" == typeof b) {
            if (d = "<" === b[0] && ">" === b[b.length -
                1] && 3 <= b.length ? [null, b, null] : R.exec(b), !d || !d[1] && c)return !c || c.jquery ? (c || fa).find(b) : this.constructor(c).find(b);
            if (d[1]) {
                if (c = c instanceof f ? c[0] : c, f.merge(this, f.parseHTML(d[1], c && c.nodeType ? c.ownerDocument || c : K, !0)), u.test(d[1]) && f.isPlainObject(c))for (d in c)f.isFunction(this[d]) ? this[d](c[d]) : this.attr(d, c[d]);
                return this
            }
            return e = K.getElementById(d[2]), e && e.parentNode && (this.length = 1, this[0] = e), this.context = K, this.selector = b, this
        }
        return b.nodeType ? (this.context = this[0] = b, this.length = 1, this) :
            f.isFunction(b) ? "undefined" != typeof fa.ready ? fa.ready(b) : b(f) : (void 0 !== b.selector && (this.selector = b.selector, this.context = b.context), f.makeArray(b, this))
    }).prototype = f.fn;
    fa = f(K);
    var Sa = /^(?:parents|prev(?:Until|All))/, qa = {children: !0, contents: !0, next: !0, prev: !0};
    f.extend({
        dir: function (b, c, d) {
            for (var e = [], h = void 0 !== d; (b = b[c]) && 9 !== b.nodeType;)if (1 === b.nodeType) {
                if (h && f(b).is(d))break;
                e.push(b)
            }
            return e
        }, sibling: function (b, c) {
            for (var d = []; b; b = b.nextSibling)1 === b.nodeType && b !== c && d.push(b);
            return d
        }
    });
    f.fn.extend({
        has: function (b) {
            var c = f(b, this), d = c.length;
            return this.filter(function () {
                for (var b = 0; d > b; b++)if (f.contains(this, c[b]))return !0
            })
        }, closest: function (b, c) {
            for (var d, e = 0, l = this.length, g = [], q = h.test(b) || "string" != typeof b ? f(b, c || this.context) : 0; l > e; e++)for (d = this[e]; d && d !== c; d = d.parentNode)if (11 > d.nodeType && (q ? -1 < q.index(d) : 1 === d.nodeType && f.find.matchesSelector(d, b))) {
                g.push(d);
                break
            }
            return this.pushStack(1 < g.length ? f.unique(g) : g)
        }, index: function (b) {
            return b ? "string" == typeof b ? S.call(f(b),
                this[0]) : S.call(this, b.jquery ? b[0] : b) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add: function (b, c) {
            return this.pushStack(f.unique(f.merge(this.get(), f(b, c))))
        }, addBack: function (b) {
            return this.add(null == b ? this.prevObject : this.prevObject.filter(b))
        }
    });
    f.each({
        parent: function (b) {
            return (b = b.parentNode) && 11 !== b.nodeType ? b : null
        }, parents: function (b) {
            return f.dir(b, "parentNode")
        }, parentsUntil: function (b, c, d) {
            return f.dir(b, "parentNode", d)
        }, next: function (b) {
            return e(b, "nextSibling")
        }, prev: function (b) {
            return e(b,
                "previousSibling")
        }, nextAll: function (b) {
            return f.dir(b, "nextSibling")
        }, prevAll: function (b) {
            return f.dir(b, "previousSibling")
        }, nextUntil: function (b, c, d) {
            return f.dir(b, "nextSibling", d)
        }, prevUntil: function (b, c, d) {
            return f.dir(b, "previousSibling", d)
        }, siblings: function (b) {
            return f.sibling((b.parentNode || {}).firstChild, b)
        }, children: function (b) {
            return f.sibling(b.firstChild)
        }, contents: function (b) {
            return b.contentDocument || f.merge([], b.childNodes)
        }
    }, function (b, c) {
        f.fn[b] = function (d, e) {
            var h = f.map(this, c,
                d);
            return "Until" !== b.slice(-5) && (e = d), e && "string" == typeof e && (h = f.filter(e, h)), 1 < this.length && (qa[b] || f.unique(h), Sa.test(b) && h.reverse()), this.pushStack(h)
        }
    });
    var W = /\S+/g, ua = {};
    f.Callbacks = function (b) {
        b = "string" == typeof b ? ua[b] || g(b) : f.extend({}, b);
        var c, d, e, h, l, q, u = [], k = !b.once && [], v = function (f) {
            c = b.memory && f;
            d = !0;
            q = h || 0;
            h = 0;
            l = u.length;
            for (e = !0; u && l > q; q++)if (!1 === u[q].apply(f[0], f[1]) && b.stopOnFalse) {
                c = !1;
                break
            }
            e = !1;
            u && (k ? k.length && v(k.shift()) : c ? u = [] : r.disable())
        }, r = {
            add: function () {
                if (u) {
                    var d =
                        u.length;
                    !function vb(c) {
                        f.each(c, function (c, p) {
                            var d = f.type(p);
                            "function" === d ? b.unique && r.has(p) || u.push(p) : p && p.length && "string" !== d && vb(p)
                        })
                    }(arguments);
                    e ? l = u.length : c && (h = d, v(c))
                }
                return this
            }, remove: function () {
                return u && f.each(arguments, function (b, c) {
                    for (var m; -1 < (m = f.inArray(c, u, m));)u.splice(m, 1), e && (l >= m && l--, q >= m && q--)
                }), this
            }, has: function (b) {
                return b ? -1 < f.inArray(b, u) : !(!u || !u.length)
            }, empty: function () {
                return u = [], l = 0, this
            }, disable: function () {
                return u = k = c = void 0, this
            }, disabled: function () {
                return !u
            },
            lock: function () {
                return k = void 0, c || r.disable(), this
            }, locked: function () {
                return !k
            }, fireWith: function (b, c) {
                return !u || d && !k || (c = c || [], c = [b, c.slice ? c.slice() : c], e ? k.push(c) : v(c)), this
            }, fire: function () {
                return r.fireWith(this, arguments), this
            }, fired: function () {
                return !!d
            }
        };
        return r
    };
    f.extend({
        Deferred: function (b) {
            var c = [["resolve", "done", f.Callbacks("once memory"), "resolved"], ["reject", "fail", f.Callbacks("once memory"), "rejected"], ["notify", "progress", f.Callbacks("memory")]],
                d = "pending", e = {
                    state: function () {
                        return d
                    },
                    always: function () {
                        return h.done(arguments).fail(arguments), this
                    }, then: function () {
                        var b = arguments;
                        return f.Deferred(function (m) {
                            f.each(c, function (c, p) {
                                var d = f.isFunction(b[c]) && b[c];
                                h[p[1]](function () {
                                    var b = d && d.apply(this, arguments);
                                    b && f.isFunction(b.promise) ? b.promise().done(m.resolve).fail(m.reject).progress(m.notify) : m[p[0] + "With"](this === e ? m.promise() : this, d ? [b] : arguments)
                                })
                            });
                            b = null
                        }).promise()
                    }, promise: function (b) {
                        return null != b ? f.extend(b, e) : e
                    }
                }, h = {};
            return e.pipe = e.then, f.each(c, function (b,
                                                        m) {
                var f = m[2], l = m[3];
                e[m[1]] = f.add;
                l && f.add(function () {
                    d = l
                }, c[1 ^ b][2].disable, c[2][2].lock);
                h[m[0]] = function () {
                    return h[m[0] + "With"](this === h ? e : this, arguments), this
                };
                h[m[0] + "With"] = f.fireWith
            }), e.promise(h), b && b.call(h, h), h
        }, when: function (b) {
            var c = 0, d = ja.call(arguments), e = d.length, h = 1 !== e || b && f.isFunction(b.promise) ? e : 0,
                l = 1 === h ? b : f.Deferred(), g = function (b, c, m) {
                    return function (p) {
                        c[b] = this;
                        m[b] = 1 < arguments.length ? ja.call(arguments) : p;
                        m === q ? l.notifyWith(c, m) : --h || l.resolveWith(c, m)
                    }
                }, q, u, k;
            if (1 < e)for (q =
                               Array(e), u = Array(e), k = Array(e); e > c; c++)d[c] && f.isFunction(d[c].promise) ? d[c].promise().done(g(c, k, d)).fail(l.reject).progress(g(c, u, q)) : --h;
            return h || l.resolveWith(k, d), l.promise()
        }
    });
    var Ma;
    f.fn.ready = function (b) {
        return f.ready.promise().done(b), this
    };
    f.extend({
        isReady: !1, readyWait: 1, holdReady: function (b) {
            b ? f.readyWait++ : f.ready(!0)
        }, ready: function (b) {
            (!0 === b ? --f.readyWait : f.isReady) || (f.isReady = !0, !0 !== b && 0 < --f.readyWait || (Ma.resolveWith(K, [f]), f.fn.triggerHandler && (f(K).triggerHandler("ready"),
                f(K).off("ready"))))
        }
    });
    f.ready.promise = function (b) {
        return Ma || (Ma = f.Deferred(), "complete" === K.readyState ? setTimeout(f.ready) : (K.addEventListener("DOMContentLoaded", k, !1), d.addEventListener("load", k, !1))), Ma.promise(b)
    };
    f.ready.promise();
    var ra = f.access = function (b, c, d, e, h, l, g) {
        var q = 0, u = b.length, k = null == d;
        if ("object" === f.type(d))for (q in h = !0, d)f.access(b, c, q, d[q], !0, l, g); else if (void 0 !== e && (h = !0, f.isFunction(e) || (g = !0), k && (g ? (c.call(b, e), c = null) : (k = c, c = function (b, c, m) {
                return k.call(f(b), m)
            })), c))for (; u >
                           q; q++)c(b[q], d, g ? e : e.call(b[q], q, c(b[q], d)));
        return h ? b : k ? c.call(b) : u ? c(b[0], d) : l
    };
    f.acceptData = function (b) {
        return 1 === b.nodeType || 9 === b.nodeType || !+b.nodeType
    };
    x.uid = 1;
    x.accepts = f.acceptData;
    x.prototype = {
        key: function (b) {
            if (!x.accepts(b))return 0;
            var c = {}, d = b[this.expando];
            if (!d) {
                d = x.uid++;
                try {
                    c[this.expando] = {value: d}, Object.defineProperties(b, c)
                } catch (e) {
                    c[this.expando] = d, f.extend(b, c)
                }
            }
            return this.cache[d] || (this.cache[d] = {}), d
        }, set: function (b, c, d) {
            var e;
            b = this.key(b);
            var h = this.cache[b];
            if ("string" ==
                typeof c) h[c] = d; else if (f.isEmptyObject(h)) f.extend(this.cache[b], c); else for (e in c)h[e] = c[e];
            return h
        }, get: function (b, c) {
            var d = this.cache[this.key(b)];
            return void 0 === c ? d : d[c]
        }, access: function (b, c, d) {
            var e;
            return void 0 === c || c && "string" == typeof c && void 0 === d ? (e = this.get(b, c), void 0 !== e ? e : this.get(b, f.camelCase(c))) : (this.set(b, c, d), void 0 !== d ? d : c)
        }, remove: function (b, c) {
            var d, e, h = this.key(b), l = this.cache[h];
            if (void 0 === c) this.cache[h] = {}; else for (f.isArray(c) ? e = c.concat(c.map(f.camelCase)) : (d = f.camelCase(c),
                c in l ? e = [c, d] : (e = d, e = e in l ? [e] : e.match(W) || [])), d = e.length; d--;)delete l[e[d]]
        }, hasData: function (b) {
            return !f.isEmptyObject(this.cache[b[this.expando]] || {})
        }, discard: function (b) {
            b[this.expando] && delete this.cache[b[this.expando]]
        }
    };
    var D = new x, Z = new x, rb = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, qb = /([A-Z])/g;
    f.extend({
        hasData: function (b) {
            return Z.hasData(b) || D.hasData(b)
        }, data: function (b, c, d) {
            return Z.access(b, c, d)
        }, removeData: function (b, c) {
            Z.remove(b, c)
        }, _data: function (b, c, d) {
            return D.access(b, c, d)
        }, _removeData: function (b,
                                  c) {
            D.remove(b, c)
        }
    });
    f.fn.extend({
        data: function (b, c) {
            var d, e, h, l = this[0], g = l && l.attributes;
            if (void 0 === b) {
                if (this.length && (h = Z.get(l), 1 === l.nodeType && !D.get(l, "hasDataAttrs"))) {
                    for (d = g.length; d--;)g[d] && (e = g[d].name, 0 === e.indexOf("data-") && (e = f.camelCase(e.slice(5)), s(l, e, h[e])));
                    D.set(l, "hasDataAttrs", !0)
                }
                return h
            }
            return "object" == typeof b ? this.each(function () {
                Z.set(this, b)
            }) : ra(this, function (c) {
                var d, p = f.camelCase(b);
                if (l && void 0 === c) {
                    if ((d = Z.get(l, b), void 0 !== d) || (d = Z.get(l, p), void 0 !== d) || (d = s(l,
                            p, void 0), void 0 !== d))return d
                } else this.each(function () {
                    var d = Z.get(this, p);
                    Z.set(this, p, c);
                    -1 !== b.indexOf("-") && void 0 !== d && Z.set(this, b, c)
                })
            }, null, c, 1 < arguments.length, null, !0)
        }, removeData: function (b) {
            return this.each(function () {
                Z.remove(this, b)
            })
        }
    });
    f.extend({
        queue: function (b, c, d) {
            var e;
            return b ? (c = (c || "fx") + "queue", e = D.get(b, c), d && (!e || f.isArray(d) ? e = D.access(b, c, f.makeArray(d)) : e.push(d)), e || []) : void 0
        }, dequeue: function (b, c) {
            c = c || "fx";
            var d = f.queue(b, c), e = d.length, h = d.shift(), l = f._queueHooks(b,
                c), g = function () {
                f.dequeue(b, c)
            };
            "inprogress" === h && (h = d.shift(), e--);
            h && ("fx" === c && d.unshift("inprogress"), delete l.stop, h.call(b, g, l));
            !e && l && l.empty.fire()
        }, _queueHooks: function (b, c) {
            var d = c + "queueHooks";
            return D.get(b, d) || D.access(b, d, {
                    empty: f.Callbacks("once memory").add(function () {
                        D.remove(b, [c + "queue", d])
                    })
                })
        }
    });
    f.fn.extend({
        queue: function (b, c) {
            var d = 2;
            return "string" != typeof b && (c = b, b = "fx", d--), arguments.length < d ? f.queue(this[0], b) : void 0 === c ? this : this.each(function () {
                var d = f.queue(this, b, c);
                f._queueHooks(this, b);
                "fx" === b && "inprogress" !== d[0] && f.dequeue(this, b)
            })
        }, dequeue: function (b) {
            return this.each(function () {
                f.dequeue(this, b)
            })
        }, clearQueue: function (b) {
            return this.queue(b || "fx", [])
        }, promise: function (b, c) {
            var d, e = 1, h = f.Deferred(), l = this, g = this.length, q = function () {
                --e || h.resolveWith(l, [l])
            };
            "string" != typeof b && (c = b, b = void 0);
            for (b = b || "fx"; g--;)(d = D.get(l[g], b + "queueHooks")) && d.empty && (e++, d.empty.add(q));
            return q(), h.promise(c)
        }
    });
    var Na = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, ta =
        ["Top", "Right", "Bottom", "Left"], Ba = function (b, c) {
        return b = c || b, "none" === f.css(b, "display") || !f.contains(b.ownerDocument, b)
    }, $a = /^(?:checkbox|radio)$/i;
    !function () {
        var b = K.createDocumentFragment().appendChild(K.createElement("div")), c = K.createElement("input");
        c.setAttribute("type", "radio");
        c.setAttribute("checked", "checked");
        c.setAttribute("name", "t");
        b.appendChild(c);
        N.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked;
        b.innerHTML = "<textarea>x</textarea>";
        N.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue
    }();
    N.focusinBubbles = "onfocusin" in d;
    var wb = /^key/, xb = /^(?:mouse|pointer|contextmenu)|click/, ab = /^(?:focusinfocus|focusoutblur)$/,
        bb = /^([^.]*)(?:\.(.+)|)$/;
    f.event = {
        global: {},
        add: function (b, c, d, e, h) {
            var l, g, q, u, k, v, r, E, n, O;
            if (k = D.get(b))for (d.handler && (l = d, d = l.handler, h = l.selector), d.guid || (d.guid = f.guid++), (u = k.events) || (u = k.events = {}), (g = k.handle) || (g = k.handle = function (c) {
                return "undefined" !== typeof f && f.event.triggered !== c.type ? f.event.dispatch.apply(b, arguments) : void 0
            }), c = (c || "").match(W) || [""], k =
                c.length; k--;)q = bb.exec(c[k]) || [], n = O = q[1], q = (q[2] || "").split(".").sort(), n && (r = f.event.special[n] || {}, n = (h ? r.delegateType : r.bindType) || n, r = f.event.special[n] || {}, v = f.extend({
                type: n,
                origType: O,
                data: e,
                handler: d,
                guid: d.guid,
                selector: h,
                needsContext: h && f.expr.match.needsContext.test(h),
                namespace: q.join(".")
            }, l), (E = u[n]) || (E = u[n] = [], E.delegateCount = 0, r.setup && !1 !== r.setup.call(b, e, q, g) || b.addEventListener && b.addEventListener(n, g, !1)), r.add && (r.add.call(b, v), v.handler.guid || (v.handler.guid = d.guid)), h ? E.splice(E.delegateCount++,
                0, v) : E.push(v), f.event.global[n] = !0)
        },
        remove: function (b, c, d, e, h) {
            var l, g, q, u, k, v, r, E, n, O, M, x = D.hasData(b) && D.get(b);
            if (x && (u = x.events)) {
                c = (c || "").match(W) || [""];
                for (k = c.length; k--;)if (q = bb.exec(c[k]) || [], n = M = q[1], O = (q[2] || "").split(".").sort(), n) {
                    r = f.event.special[n] || {};
                    n = (e ? r.delegateType : r.bindType) || n;
                    E = u[n] || [];
                    q = q[2] && new RegExp("(^|\\.)" + O.join("\\.(?:.*\\.|)") + "(\\.|$)");
                    for (g = l = E.length; l--;)v = E[l], !h && M !== v.origType || d && d.guid !== v.guid || q && !q.test(v.namespace) || e && e !== v.selector && ("**" !==
                    e || !v.selector) || (E.splice(l, 1), v.selector && E.delegateCount--, r.remove && r.remove.call(b, v));
                    g && !E.length && (r.teardown && !1 !== r.teardown.call(b, O, x.handle) || f.removeEvent(b, n, x.handle), delete u[n])
                } else for (n in u)f.event.remove(b, n + c[k], d, e, !0);
                f.isEmptyObject(u) && (delete x.handle, D.remove(b, "events"))
            }
        },
        trigger: function (b, c, e, h) {
            var l, g, q, u, k, v, r, n = [e || K], E = oa.call(b, "type") ? b.type : b;
            l = oa.call(b, "namespace") ? b.namespace.split(".") : [];
            if (g = q = e = e || K, 3 !== e.nodeType && 8 !== e.nodeType && !ab.test(E + f.event.triggered) &&
                (0 <= E.indexOf(".") && (l = E.split("."), E = l.shift(), l.sort()), k = 0 > E.indexOf(":") && "on" + E, b = b[f.expando] ? b : new f.Event(E, "object" == typeof b && b), b.isTrigger = h ? 2 : 3, b.namespace = l.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + l.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = e), c = null == c ? [b] : f.makeArray(c, [b]), r = f.event.special[E] || {}, h || !r.trigger || !1 !== r.trigger.apply(e, c))) {
                if (!h && !r.noBubble && !f.isWindow(e)) {
                    u = r.delegateType || E;
                    for (ab.test(u + E) || (g = g.parentNode); g; g =
                        g.parentNode)n.push(g), q = g;
                    q === (e.ownerDocument || K) && n.push(q.defaultView || q.parentWindow || d)
                }
                for (l = 0; (g = n[l++]) && !b.isPropagationStopped();)b.type = 1 < l ? u : r.bindType || E, (v = (D.get(g, "events") || {})[b.type] && D.get(g, "handle")) && v.apply(g, c), (v = k && g[k]) && v.apply && f.acceptData(g) && (b.result = v.apply(g, c), !1 === b.result && b.preventDefault());
                return b.type = E, h || b.isDefaultPrevented() || r._default && !1 !== r._default.apply(n.pop(), c) || !f.acceptData(e) || k && f.isFunction(e[E]) && !f.isWindow(e) && (q = e[k], q && (e[k] = null),
                    f.event.triggered = E, e[E](), f.event.triggered = void 0, q && (e[k] = q)), b.result
            }
        },
        dispatch: function (b) {
            b = f.event.fix(b);
            var c, d, e, h, l, g = [], q = ja.call(arguments);
            c = (D.get(this, "events") || {})[b.type] || [];
            var u = f.event.special[b.type] || {};
            if (q[0] = b, b.delegateTarget = this, !u.preDispatch || !1 !== u.preDispatch.call(this, b)) {
                g = f.event.handlers.call(this, b, c);
                for (c = 0; (h = g[c++]) && !b.isPropagationStopped();)for (b.currentTarget = h.elem, d = 0; (l = h.handlers[d++]) && !b.isImmediatePropagationStopped();)b.namespace_re && !b.namespace_re.test(l.namespace) ||
                (b.handleObj = l, b.data = l.data, e = ((f.event.special[l.origType] || {}).handle || l.handler).apply(h.elem, q), void 0 === e || !1 !== (b.result = e) || (b.preventDefault(), b.stopPropagation()));
                return u.postDispatch && u.postDispatch.call(this, b), b.result
            }
        },
        handlers: function (b, c) {
            var d, e, h, l, g = [], q = c.delegateCount, u = b.target;
            if (q && u.nodeType && (!b.button || "click" !== b.type))for (; u !== this; u = u.parentNode || this)if (!0 !== u.disabled || "click" !== b.type) {
                e = [];
                for (d = 0; q > d; d++)l = c[d], h = l.selector + " ", void 0 === e[h] && (e[h] = l.needsContext ?
                    0 <= f(h, this).index(u) : f.find(h, this, null, [u]).length), e[h] && e.push(l);
                e.length && g.push({elem: u, handlers: e})
            }
            return q < c.length && g.push({elem: this, handlers: c.slice(q)}), g
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: ["char", "charCode", "key", "keyCode"], filter: function (b, c) {
                return null == b.which && (b.which = null != c.charCode ? c.charCode : c.keyCode), b
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function (b, c) {
                var d, f, e, h = c.button;
                return null == b.pageX && null != c.clientX && (d = b.target.ownerDocument || K, f = d.documentElement, e = d.body, b.pageX = c.clientX + (f && f.scrollLeft || e && e.scrollLeft || 0) - (f && f.clientLeft || e && e.clientLeft || 0), b.pageY = c.clientY + (f && f.scrollTop || e && e.scrollTop || 0) - (f && f.clientTop || e && e.clientTop || 0)), b.which || void 0 === h || (b.which = 1 & h ? 1 : 2 & h ? 3 : 4 & h ? 2 : 0), b
            }
        },
        fix: function (b) {
            if (b[f.expando])return b;
            var c, d, e;
            c = b.type;
            var h = b, l = this.fixHooks[c];
            l || (this.fixHooks[c] = l = xb.test(c) ? this.mouseHooks :
                wb.test(c) ? this.keyHooks : {});
            e = l.props ? this.props.concat(l.props) : this.props;
            b = new f.Event(h);
            for (c = e.length; c--;)d = e[c], b[d] = h[d];
            return b.target || (b.target = K), 3 === b.target.nodeType && (b.target = b.target.parentNode), l.filter ? l.filter(b, h) : b
        },
        special: {
            load: {noBubble: !0}, focus: {
                trigger: function () {
                    return this !== H() && this.focus ? (this.focus(), !1) : void 0
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    return this === H() && this.blur ? (this.blur(), !1) : void 0
                }, delegateType: "focusout"
            }, click: {
                trigger: function () {
                    return "checkbox" ===
                    this.type && this.click && f.nodeName(this, "input") ? (this.click(), !1) : void 0
                }, _default: function (b) {
                    return f.nodeName(b.target, "a")
                }
            }, beforeunload: {
                postDispatch: function (b) {
                    void 0 !== b.result && b.originalEvent && (b.originalEvent.returnValue = b.result)
                }
            }
        },
        simulate: function (b, c, d, e) {
            b = f.extend(new f.Event, d, {type: b, isSimulated: !0, originalEvent: {}});
            e ? f.event.trigger(b, null, c) : f.event.dispatch.call(c, b);
            b.isDefaultPrevented() && d.preventDefault()
        }
    };
    f.removeEvent = function (b, c, d) {
        b.removeEventListener && b.removeEventListener(c,
            d, !1)
    };
    f.Event = function (b, c) {
        return this instanceof f.Event ? (b && b.type ? (this.originalEvent = b, this.type = b.type, this.isDefaultPrevented = b.defaultPrevented || void 0 === b.defaultPrevented && !1 === b.returnValue ? G : C) : this.type = b, c && f.extend(this, c), this.timeStamp = b && b.timeStamp || f.now(), void(this[f.expando] = !0)) : new f.Event(b, c)
    };
    f.Event.prototype = {
        isDefaultPrevented: C, isPropagationStopped: C, isImmediatePropagationStopped: C, preventDefault: function () {
            var b = this.originalEvent;
            this.isDefaultPrevented = G;
            b && b.preventDefault &&
            b.preventDefault()
        }, stopPropagation: function () {
            var b = this.originalEvent;
            this.isPropagationStopped = G;
            b && b.stopPropagation && b.stopPropagation()
        }, stopImmediatePropagation: function () {
            var b = this.originalEvent;
            this.isImmediatePropagationStopped = G;
            b && b.stopImmediatePropagation && b.stopImmediatePropagation();
            this.stopPropagation()
        }
    };
    f.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (b, c) {
        f.event.special[b] = {
            delegateType: c, bindType: c, handle: function (b) {
                var d,
                    m = b.relatedTarget, e = b.handleObj;
                return (!m || m !== this && !f.contains(this, m)) && (b.type = e.origType, d = e.handler.apply(this, arguments), b.type = c), d
            }
        }
    });
    N.focusinBubbles || f.each({focus: "focusin", blur: "focusout"}, function (b, c) {
        var d = function (b) {
            f.event.simulate(c, b.target, f.event.fix(b), !0)
        };
        f.event.special[c] = {
            setup: function () {
                var f = this.ownerDocument || this, e = D.access(f, c);
                e || f.addEventListener(b, d, !0);
                D.access(f, c, (e || 0) + 1)
            }, teardown: function () {
                var f = this.ownerDocument || this, e = D.access(f, c) - 1;
                e ? D.access(f,
                    c, e) : (f.removeEventListener(b, d, !0), D.remove(f, c))
            }
        }
    });
    f.fn.extend({
        on: function (b, c, d, e, h) {
            var l, g;
            if ("object" == typeof b) {
                "string" != typeof c && (d = d || c, c = void 0);
                for (g in b)this.on(g, c, d, b[g], h);
                return this
            }
            if (null == d && null == e ? (e = c, d = c = void 0) : null == e && ("string" == typeof c ? (e = d, d = void 0) : (e = d, d = c, c = void 0)), !1 === e) e = C; else if (!e)return this;
            return 1 === h && (l = e, e = function (b) {
                return f().off(b), l.apply(this, arguments)
            }, e.guid = l.guid || (l.guid = f.guid++)), this.each(function () {
                f.event.add(this, b, e, d, c)
            })
        }, one: function (b,
                          c, d, f) {
            return this.on(b, c, d, f, 1)
        }, off: function (b, c, d) {
            var e, h;
            if (b && b.preventDefault && b.handleObj)return e = b.handleObj, f(b.delegateTarget).off(e.namespace ? e.origType + "." + e.namespace : e.origType, e.selector, e.handler), this;
            if ("object" == typeof b) {
                for (h in b)this.off(h, c, b[h]);
                return this
            }
            return (!1 === c || "function" == typeof c) && (d = c, c = void 0), !1 === d && (d = C), this.each(function () {
                f.event.remove(this, b, d, c)
            })
        }, trigger: function (b, c) {
            return this.each(function () {
                f.event.trigger(b, c, this)
            })
        }, triggerHandler: function (b,
                                     c) {
            var d = this[0];
            return d ? f.event.trigger(b, c, d, !0) : void 0
        }
    });
    var cb = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, db = /<([\w:]+)/,
        yb = /<|&#?\w+;/, zb = /<(?:script|style|link)/i, Ab = /checked\s*(?:[^=]|=\s*.checked.)/i,
        eb = /^$|\/(?:java|ecma)script/i, sb = /^true\/(.*)/, Bb = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, ha = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };
    ha.optgroup = ha.option;
    ha.tbody = ha.tfoot = ha.colgroup = ha.caption = ha.thead;
    ha.th = ha.td;
    f.extend({
        clone: function (b, c, d) {
            var e, h, l, g, q = b.cloneNode(!0), u = f.contains(b.ownerDocument, b);
            if (!(N.noCloneChecked || 1 !== b.nodeType && 11 !== b.nodeType || f.isXMLDoc(b)))for (g = F(q), l = F(b), e = 0, h = l.length; h > e; e++) {
                var k = l[e], v = g[e], r = v.nodeName.toLowerCase();
                "input" === r && $a.test(k.type) ? v.checked = k.checked : ("input" === r || "textarea" === r) && (v.defaultValue =
                        k.defaultValue)
            }
            if (c)if (d)for (l = l || F(b), g = g || F(q), e = 0, h = l.length; h > e; e++)w(l[e], g[e]); else w(b, q);
            return g = F(q, "script"), 0 < g.length && ca(g, !u && F(b, "script")), q
        }, buildFragment: function (b, c, d, e) {
            for (var h, l, g, q, u = c.createDocumentFragment(), k = [], v = 0, r = b.length; r > v; v++)if (h = b[v], h || 0 === h)if ("object" === f.type(h)) f.merge(k, h.nodeType ? [h] : h); else if (yb.test(h)) {
                l = l || u.appendChild(c.createElement("div"));
                g = (db.exec(h) || ["", ""])[1].toLowerCase();
                g = ha[g] || ha._default;
                l.innerHTML = g[1] + h.replace(cb, "<$1></$2>") +
                    g[2];
                for (g = g[0]; g--;)l = l.lastChild;
                f.merge(k, l.childNodes);
                l = u.firstChild;
                l.textContent = ""
            } else k.push(c.createTextNode(h));
            u.textContent = "";
            for (v = 0; h = k[v++];)if ((!e || -1 === f.inArray(h, e)) && (q = f.contains(h.ownerDocument, h), l = F(u.appendChild(h), "script"), q && ca(l), d))for (g = 0; h = l[g++];)eb.test(h.type || "") && d.push(h);
            return u
        }, cleanData: function (b) {
            for (var c, d, e, h, l = f.event.special, g = 0; void 0 !== (d = b[g]); g++) {
                if (f.acceptData(d) && (h = d[D.expando], h && (c = D.cache[h]))) {
                    if (c.events)for (e in c.events)l[e] ? f.event.remove(d,
                        e) : f.removeEvent(d, e, c.handle);
                    D.cache[h] && delete D.cache[h]
                }
                delete Z.cache[d[Z.expando]]
            }
        }
    });
    f.fn.extend({
        text: function (b) {
            return ra(this, function (b) {
                return void 0 === b ? f.text(this) : this.empty().each(function () {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = b)
                })
            }, null, b, arguments.length)
        }, append: function () {
            return this.domManip(arguments, function (b) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || P(this, b).appendChild(b)
            })
        }, prepend: function () {
            return this.domManip(arguments,
                function (b) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var c = P(this, b);
                        c.insertBefore(b, c.firstChild)
                    }
                })
        }, before: function () {
            return this.domManip(arguments, function (b) {
                this.parentNode && this.parentNode.insertBefore(b, this)
            })
        }, after: function () {
            return this.domManip(arguments, function (b) {
                this.parentNode && this.parentNode.insertBefore(b, this.nextSibling)
            })
        }, remove: function (b, c) {
            for (var d, e = b ? f.filter(b, this) : this, h = 0; null != (d = e[h]); h++)c || 1 !== d.nodeType || f.cleanData(F(d)), d.parentNode &&
            (c && f.contains(d.ownerDocument, d) && ca(F(d, "script")), d.parentNode.removeChild(d));
            return this
        }, empty: function () {
            for (var b, c = 0; null != (b = this[c]); c++)1 === b.nodeType && (f.cleanData(F(b, !1)), b.textContent = "");
            return this
        }, clone: function (b, c) {
            return b = null == b ? !1 : b, c = null == c ? b : c, this.map(function () {
                return f.clone(this, b, c)
            })
        }, html: function (b) {
            return ra(this, function (b) {
                var c = this[0] || {}, d = 0, e = this.length;
                if (void 0 === b && 1 === c.nodeType)return c.innerHTML;
                if ("string" == typeof b && !zb.test(b) && !ha[(db.exec(b) ||
                    ["", ""])[1].toLowerCase()]) {
                    b = b.replace(cb, "<$1></$2>");
                    try {
                        for (; e > d; d++)c = this[d] || {}, 1 === c.nodeType && (f.cleanData(F(c, !1)), c.innerHTML = b);
                        c = 0
                    } catch (m) {
                    }
                }
                c && this.empty().append(b)
            }, null, b, arguments.length)
        }, replaceWith: function () {
            var b = arguments[0];
            return this.domManip(arguments, function (c) {
                b = this.parentNode;
                f.cleanData(F(this));
                b && b.replaceChild(c, this)
            }), b && (b.length || b.nodeType) ? this : this.remove()
        }, detach: function (b) {
            return this.remove(b, !0)
        }, domManip: function (b, c) {
            b = la.apply([], b);
            var d, e, h,
                l, g = 0, q = this.length, u = this, k = q - 1, v = b[0], r = f.isFunction(v);
            if (r || 1 < q && "string" == typeof v && !N.checkClone && Ab.test(v))return this.each(function (d) {
                var e = u.eq(d);
                r && (b[0] = v.call(this, d, e.html()));
                e.domManip(b, c)
            });
            if (q && (d = f.buildFragment(b, this[0].ownerDocument, !1, this), e = d.firstChild, 1 === d.childNodes.length && (d = e), e)) {
                e = f.map(F(d, "script"), T);
                for (h = e.length; q > g; g++)l = d, g !== k && (l = f.clone(l, !0, !0), h && f.merge(e, F(l, "script"))), c.call(this[g], l, g);
                if (h)for (d = e[e.length - 1].ownerDocument, f.map(e, ea), g = 0; h >
                g; g++)l = e[g], eb.test(l.type || "") && !D.access(l, "globalEval") && f.contains(d, l) && (l.src ? f._evalUrl && f._evalUrl(l.src) : f.globalEval(l.textContent.replace(Bb, "")))
            }
            return this
        }
    });
    f.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (b, c) {
        f.fn[b] = function (b) {
            for (var d = [], e = f(b), m = e.length - 1, h = 0; m >= h; h++)b = h === m ? this : this.clone(!0), f(e[h])[c](b), M.apply(d, b.get());
            return this.pushStack(d)
        }
    });
    var Ha, Xa = {}, Ya = /^margin/, Qa = new RegExp("^(" +
        Na + ")(?!px)[a-z%]+$", "i"), Ia = function (b) {
        return b.ownerDocument.defaultView.getComputedStyle(b, null)
    };
    !function () {
        var b, c, e = K.documentElement, h = K.createElement("div"), l = K.createElement("div");
        if (l.style) {
            var g = function () {
                l.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute";
                l.innerHTML = "";
                e.appendChild(h);
                var f = d.getComputedStyle(l, null);
                b = "1%" !== f.top;
                c = "4px" === f.width;
                e.removeChild(h)
            };
            l.style.backgroundClip = "content-box";
            l.cloneNode(!0).style.backgroundClip = "";
            N.clearCloneStyle = "content-box" === l.style.backgroundClip;
            h.style.cssText = "border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;position:absolute";
            h.appendChild(l);
            d.getComputedStyle && f.extend(N, {
                pixelPosition: function () {
                    return g(), b
                }, boxSizingReliable: function () {
                    return null == c && g(), c
                }, reliableMarginRight: function () {
                    var b, c = l.appendChild(K.createElement("div"));
                    return c.style.cssText = l.style.cssText =
                        "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", c.style.marginRight = c.style.width = "0", l.style.width = "1px", e.appendChild(h), b = !parseFloat(d.getComputedStyle(c, null).marginRight), e.removeChild(h), b
                }
            })
        }
    }();
    f.swap = function (b, c, d, e) {
        var f, h = {};
        for (f in c)h[f] = b.style[f], b.style[f] = c[f];
        d = d.apply(b, e || []);
        for (f in c)b.style[f] = h[f];
        return d
    };
    var Cb = /^(none|table(?!-c[ea]).+)/, tb = new RegExp("^(" + Na + ")(.*)$", "i"), Db = new RegExp("^([+-])=(" +
            Na + ")", "i"), Eb = {position: "absolute", visibility: "hidden", display: "block"},
        fb = {letterSpacing: "0", fontWeight: "400"}, Za = ["Webkit", "O", "Moz", "ms"];
    f.extend({
        cssHooks: {
            opacity: {
                get: function (b, c) {
                    if (c) {
                        var d = I(b, "opacity");
                        return "" === d ? "1" : d
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {"float": "cssFloat"},
        style: function (b, c, d, e) {
            if (b && 3 !== b.nodeType && 8 !== b.nodeType && b.style) {
                var h,
                    l, g, q = f.camelCase(c), u = b.style;
                return c = f.cssProps[q] || (f.cssProps[q] = L(u, q)), g = f.cssHooks[c] || f.cssHooks[q], void 0 === d ? g && "get" in g && void 0 !== (h = g.get(b, !1, e)) ? h : u[c] : (l = typeof d, "string" === l && (h = Db.exec(d)) && (d = (h[1] + 1) * h[2] + parseFloat(f.css(b, c)), l = "number"), null != d && d === d && ("number" !== l || f.cssNumber[q] || (d += "px"), N.clearCloneStyle || "" !== d || 0 !== c.indexOf("background") || (u[c] = "inherit"), g && "set" in g && void 0 === (d = g.set(b, d, e)) || (u[c] = d)), void 0)
            }
        },
        css: function (b, c, d, e) {
            var h, l, g, q = f.camelCase(c);
            return c = f.cssProps[q] || (f.cssProps[q] = L(b.style, q)), g = f.cssHooks[c] || f.cssHooks[q], g && "get" in g && (h = g.get(b, !0, d)), void 0 === h && (h = I(b, c, e)), "normal" === h && c in fb && (h = fb[c]), "" === d || d ? (l = parseFloat(h), !0 === d || f.isNumeric(l) ? l || 0 : h) : h
        }
    });
    f.each(["height", "width"], function (c, d) {
        f.cssHooks[d] = {
            get: function (b, c, e) {
                return c ? Cb.test(f.css(b, "display")) && 0 === b.offsetWidth ? f.swap(b, Eb, function () {
                    return ka(b, d, e)
                }) : ka(b, d, e) : void 0
            }, set: function (c, e, m) {
                var h = m && Ia(c);
                return za(c, e, m ? b(c, d, m, "border-box" ===
                    f.css(c, "boxSizing", !1, h), h) : 0)
            }
        }
    });
    f.cssHooks.marginRight = V(N.reliableMarginRight, function (b, c) {
        return c ? f.swap(b, {display: "inline-block"}, I, [b, "marginRight"]) : void 0
    });
    f.each({margin: "", padding: "", border: "Width"}, function (b, c) {
        f.cssHooks[b + c] = {
            expand: function (d) {
                var e = 0, f = {};
                for (d = "string" == typeof d ? d.split(" ") : [d]; 4 > e; e++)f[b + ta[e] + c] = d[e] || d[e - 2] || d[0];
                return f
            }
        };
        Ya.test(b) || (f.cssHooks[b + c].set = za)
    });
    f.fn.extend({
        css: function (b, c) {
            return ra(this, function (b, c, d) {
                var e, m = {}, h = 0;
                if (f.isArray(c)) {
                    d =
                        Ia(b);
                    for (e = c.length; e > h; h++)m[c[h]] = f.css(b, c[h], !1, d);
                    return m
                }
                return void 0 !== d ? f.style(b, c, d) : f.css(b, c)
            }, b, c, 1 < arguments.length)
        }, show: function () {
            return r(this, !0)
        }, hide: function () {
            return r(this)
        }, toggle: function (b) {
            return "boolean" == typeof b ? b ? this.show() : this.hide() : this.each(function () {
                Ba(this) ? f(this).show() : f(this).hide()
            })
        }
    });
    f.Tween = z;
    z.prototype = {
        constructor: z, init: function (b, c, d, e, h, l) {
            this.elem = b;
            this.prop = d;
            this.easing = h || "swing";
            this.options = c;
            this.start = this.now = this.cur();
            this.end =
                e;
            this.unit = l || (f.cssNumber[d] ? "" : "px")
        }, cur: function () {
            var b = z.propHooks[this.prop];
            return b && b.get ? b.get(this) : z.propHooks._default.get(this)
        }, run: function (b) {
            var c, d = z.propHooks[this.prop];
            return this.pos = c = this.options.duration ? f.easing[this.easing](b, this.options.duration * b, 0, 1, this.options.duration) : b, this.now = (this.end - this.start) * c + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), d && d.set ? d.set(this) : z.propHooks._default.set(this), this
        }
    };
    z.prototype.init.prototype =
        z.prototype;
    z.propHooks = {
        _default: {
            get: function (b) {
                var c;
                return null == b.elem[b.prop] || b.elem.style && null != b.elem.style[b.prop] ? (c = f.css(b.elem, b.prop, ""), c && "auto" !== c ? c : 0) : b.elem[b.prop]
            }, set: function (b) {
                f.fx.step[b.prop] ? f.fx.step[b.prop](b) : b.elem.style && (null != b.elem.style[f.cssProps[b.prop]] || f.cssHooks[b.prop]) ? f.style(b.elem, b.prop, b.now + b.unit) : b.elem[b.prop] = b.now
            }
        }
    };
    z.propHooks.scrollTop = z.propHooks.scrollLeft = {
        set: function (b) {
            b.elem.nodeType && b.elem.parentNode && (b.elem[b.prop] = b.now)
        }
    };
    f.easing = {
        linear: function (b) {
            return b
        }, swing: function (b) {
            return .5 - Math.cos(b * Math.PI) / 2
        }
    };
    f.fx = z.prototype.init;
    f.fx.step = {};
    var va, Oa, Fb = /^(?:toggle|show|hide)$/, gb = new RegExp("^(?:([+-])=|)(" + Na + ")([a-z%]*)$", "i"),
        Gb = /queueHooks$/, Ja = [function (b, c, d) {
            var e, h, l, g, u, k, r, E = this, n = {}, O = b.style, x = b.nodeType && Ba(b), M = D.get(b, "fxshow");
            d.queue || (g = f._queueHooks(b, "fx"), null == g.unqueued && (g.unqueued = 0, u = g.empty.fire, g.empty.fire = function () {
                g.unqueued || u()
            }), g.unqueued++, E.always(function () {
                E.always(function () {
                    g.unqueued--;
                    f.queue(b, "fx").length || g.empty.fire()
                })
            }));
            1 === b.nodeType && ("height" in c || "width" in c) && (d.overflow = [O.overflow, O.overflowX, O.overflowY], k = f.css(b, "display"), r = "none" === k ? D.get(b, "olddisplay") || q(b.nodeName) : k, "inline" === r && "none" === f.css(b, "float") && (O.display = "inline-block"));
            d.overflow && (O.overflow = "hidden", E.always(function () {
                O.overflow = d.overflow[0];
                O.overflowX = d.overflow[1];
                O.overflowY = d.overflow[2]
            }));
            for (e in c)if (h = c[e], Fb.exec(h)) {
                if (delete c[e], l = l || "toggle" === h, h === (x ? "hide" : "show")) {
                    if ("show" !==
                        h || !M || void 0 === M[e])continue;
                    x = !0
                }
                n[e] = M && M[e] || f.style(b, e)
            } else k = void 0;
            if (f.isEmptyObject(n)) "inline" === ("none" === k ? q(b.nodeName) : k) && (O.display = k); else for (e in M ? "hidden" in M && (x = M.hidden) : M = D.access(b, "fxshow", {}), l && (M.hidden = !x), x ? f(b).show() : E.done(function () {
                f(b).hide()
            }), E.done(function () {
                var c;
                D.remove(b, "fxshow");
                for (c in n)f.style(b, c, n[c])
            }), n)c = v(x ? M[e] : 0, e, E), e in M || (M[e] = c.start, x && (c.end = c.start, c.start = "width" === e || "height" === e ? 1 : 0))
        }], Da = {
            "*": [function (b, c) {
                var d = this.createTween(b,
                    c), e = d.cur(), h = gb.exec(c), l = h && h[3] || (f.cssNumber[b] ? "" : "px"),
                    g = (f.cssNumber[b] || "px" !== l && +e) && gb.exec(f.css(d.elem, b)), q = 1, u = 20;
                if (g && g[3] !== l) {
                    l = l || g[3];
                    h = h || [];
                    g = +e || 1;
                    do q = q || ".5", g /= q, f.style(d.elem, b, g + l); while (q !== (q = d.cur() / e) && 1 !== q && --u)
                }
                return h && (g = d.start = +g || +e || 0, d.unit = l, d.end = h[1] ? g + (h[1] + 1) * h[2] : +h[2]), d
            }]
        };
    f.Animation = f.extend(aa, {
        tweener: function (b, c) {
            f.isFunction(b) ? (c = b, b = ["*"]) : b = b.split(" ");
            for (var d, e = 0, h = b.length; h > e; e++)d = b[e], Da[d] = Da[d] || [], Da[d].unshift(c)
        }, prefilter: function (b,
                                c) {
            c ? Ja.unshift(b) : Ja.push(b)
        }
    });
    f.speed = function (b, c, d) {
        var e = b && "object" == typeof b ? f.extend({}, b) : {
            complete: d || !d && c || f.isFunction(b) && b,
            duration: b,
            easing: d && c || c && !f.isFunction(c) && c
        };
        return e.duration = f.fx.off ? 0 : "number" == typeof e.duration ? e.duration : e.duration in f.fx.speeds ? f.fx.speeds[e.duration] : f.fx.speeds._default, (null == e.queue || !0 === e.queue) && (e.queue = "fx"), e.old = e.complete, e.complete = function () {
            f.isFunction(e.old) && e.old.call(this);
            e.queue && f.dequeue(this, e.queue)
        }, e
    };
    f.fn.extend({
        fadeTo: function (b,
                          c, d, e) {
            return this.filter(Ba).css("opacity", 0).show().end().animate({opacity: c}, b, d, e)
        }, animate: function (b, c, d, e) {
            var h = f.isEmptyObject(b), l = f.speed(c, d, e);
            c = function () {
                var c = aa(this, f.extend({}, b), l);
                (h || D.get(this, "finish")) && c.stop(!0)
            };
            return c.finish = c, h || !1 === l.queue ? this.each(c) : this.queue(l.queue, c)
        }, stop: function (b, c, d) {
            var e = function (b) {
                var c = b.stop;
                delete b.stop;
                c(d)
            };
            return "string" != typeof b && (d = c, c = b, b = void 0), c && !1 !== b && this.queue(b || "fx", []), this.each(function () {
                var c = !0, h = null != b &&
                    b + "queueHooks", l = f.timers, p = D.get(this);
                if (h) p[h] && p[h].stop && e(p[h]); else for (h in p)p[h] && p[h].stop && Gb.test(h) && e(p[h]);
                for (h = l.length; h--;)l[h].elem !== this || null != b && l[h].queue !== b || (l[h].anim.stop(d), c = !1, l.splice(h, 1));
                !c && d || f.dequeue(this, b)
            })
        }, finish: function (b) {
            return !1 !== b && (b = b || "fx"), this.each(function () {
                var c, d = D.get(this), e = d[b + "queue"];
                c = d[b + "queueHooks"];
                var h = f.timers, l = e ? e.length : 0;
                d.finish = !0;
                f.queue(this, b, []);
                c && c.stop && c.stop.call(this, !0);
                for (c = h.length; c--;)h[c].elem === this &&
                h[c].queue === b && (h[c].anim.stop(!0), h.splice(c, 1));
                for (c = 0; l > c; c++)e[c] && e[c].finish && e[c].finish.call(this);
                delete d.finish
            })
        }
    });
    f.each(["toggle", "show", "hide"], function (b, c) {
        var d = f.fn[c];
        f.fn[c] = function (b, e, f) {
            return null == b || "boolean" == typeof b ? d.apply(this, arguments) : this.animate(l(c, !0), b, e, f)
        }
    });
    f.each({
        slideDown: l("show"),
        slideUp: l("hide"),
        slideToggle: l("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (b, c) {
        f.fn[b] = function (b, d, e) {
            return this.animate(c,
                b, d, e)
        }
    });
    f.timers = [];
    f.fx.tick = function () {
        var b, c = 0, d = f.timers;
        for (va = f.now(); c < d.length; c++)b = d[c], b() || d[c] !== b || d.splice(c--, 1);
        d.length || f.fx.stop();
        va = void 0
    };
    f.fx.timer = function (b) {
        f.timers.push(b);
        b() ? f.fx.start() : f.timers.pop()
    };
    f.fx.interval = 13;
    f.fx.start = function () {
        Oa || (Oa = setInterval(f.fx.tick, f.fx.interval))
    };
    f.fx.stop = function () {
        clearInterval(Oa);
        Oa = null
    };
    f.fx.speeds = {slow: 600, fast: 200, _default: 400};
    f.fn.delay = function (b, c) {
        return b = f.fx ? f.fx.speeds[b] || b : b, c = c || "fx", this.queue(c, function (c,
                                                                                          d) {
            var e = setTimeout(c, b);
            d.stop = function () {
                clearTimeout(e)
            }
        })
    };
    (function () {
        var b = K.createElement("input"), c = K.createElement("select"), d = c.appendChild(K.createElement("option"));
        b.type = "checkbox";
        N.checkOn = "" !== b.value;
        N.optSelected = d.selected;
        c.disabled = !0;
        N.optDisabled = !d.disabled;
        b = K.createElement("input");
        b.value = "t";
        b.type = "radio";
        N.radioValue = "t" === b.value
    })();
    var hb, Fa = f.expr.attrHandle;
    f.fn.extend({
        attr: function (b, c) {
            return ra(this, f.attr, b, c, 1 < arguments.length)
        }, removeAttr: function (b) {
            return this.each(function () {
                f.removeAttr(this,
                    b)
            })
        }
    });
    f.extend({
        attr: function (b, c, d) {
            var e, h, l = b.nodeType;
            if (b && 3 !== l && 8 !== l && 2 !== l)return "undefined" === typeof b.getAttribute ? f.prop(b, c, d) : (1 === l && f.isXMLDoc(b) || (c = c.toLowerCase(), e = f.attrHooks[c] || (f.expr.match.bool.test(c) ? hb : void 0)), void 0 === d ? e && "get" in e && null !== (h = e.get(b, c)) ? h : (h = f.find.attr(b, c), null == h ? void 0 : h) : null !== d ? e && "set" in e && void 0 !== (h = e.set(b, d, c)) ? h : (b.setAttribute(c, d + ""), d) : void f.removeAttr(b, c))
        }, removeAttr: function (b, c) {
            var d, e, h = 0, l = c && c.match(W);
            if (l && 1 === b.nodeType)for (; d =
                                                 l[h++];)e = f.propFix[d] || d, f.expr.match.bool.test(d) && (b[e] = !1), b.removeAttribute(d)
        }, attrHooks: {
            type: {
                set: function (b, c) {
                    if (!N.radioValue && "radio" === c && f.nodeName(b, "input")) {
                        var d = b.value;
                        return b.setAttribute("type", c), d && (b.value = d), c
                    }
                }
            }
        }
    });
    hb = {
        set: function (b, c, d) {
            return !1 === c ? f.removeAttr(b, d) : b.setAttribute(d, d), d
        }
    };
    f.each(f.expr.match.bool.source.match(/\w+/g), function (b, c) {
        var d = Fa[c] || f.find.attr;
        Fa[c] = function (b, c, e) {
            var f, h;
            return e || (h = Fa[c], Fa[c] = f, f = null != d(b, c, e) ? c.toLowerCase() : null,
                Fa[c] = h), f
        }
    });
    var Hb = /^(?:input|select|textarea|button)$/i;
    f.fn.extend({
        prop: function (b, c) {
            return ra(this, f.prop, b, c, 1 < arguments.length)
        }, removeProp: function (b) {
            return this.each(function () {
                delete this[f.propFix[b] || b]
            })
        }
    });
    f.extend({
        propFix: {"for": "htmlFor", "class": "className"}, prop: function (b, c, d) {
            var e, h, l, g = b.nodeType;
            if (b && 3 !== g && 8 !== g && 2 !== g)return l = 1 !== g || !f.isXMLDoc(b), l && (c = f.propFix[c] || c, h = f.propHooks[c]), void 0 !== d ? h && "set" in h && void 0 !== (e = h.set(b, d, c)) ? e : b[c] = d : h && "get" in h && null !==
            (e = h.get(b, c)) ? e : b[c]
        }, propHooks: {
            tabIndex: {
                get: function (b) {
                    return b.hasAttribute("tabindex") || Hb.test(b.nodeName) || b.href ? b.tabIndex : -1
                }
            }
        }
    });
    N.optSelected || (f.propHooks.selected = {
        get: function (b) {
            b = b.parentNode;
            return b && b.parentNode && b.parentNode.selectedIndex, null
        }
    });
    f.each("tabIndex readOnly maxLength cellSpacing cellPadding rowSpan colSpan useMap frameBorder contentEditable".split(" "), function () {
        f.propFix[this.toLowerCase()] = this
    });
    var Ta = /[\t\r\n\f]/g;
    f.fn.extend({
        addClass: function (b) {
            var c,
                d, e, h, l;
            c = "string" == typeof b && b;
            var g = 0, q = this.length;
            if (f.isFunction(b))return this.each(function (c) {
                f(this).addClass(b.call(this, c, this.className))
            });
            if (c)for (c = (b || "").match(W) || []; q > g; g++)if (d = this[g], e = 1 === d.nodeType && (d.className ? (" " + d.className + " ").replace(Ta, " ") : " ")) {
                for (l = 0; h = c[l++];)0 > e.indexOf(" " + h + " ") && (e += h + " ");
                e = f.trim(e);
                d.className !== e && (d.className = e)
            }
            return this
        }, removeClass: function (b) {
            var c, d, e, h, l;
            c = 0 === arguments.length || "string" == typeof b && b;
            var g = 0, q = this.length;
            if (f.isFunction(b))return this.each(function (c) {
                f(this).removeClass(b.call(this,
                    c, this.className))
            });
            if (c)for (c = (b || "").match(W) || []; q > g; g++)if (d = this[g], e = 1 === d.nodeType && (d.className ? (" " + d.className + " ").replace(Ta, " ") : "")) {
                for (l = 0; h = c[l++];)for (; 0 <= e.indexOf(" " + h + " ");)e = e.replace(" " + h + " ", " ");
                e = b ? f.trim(e) : "";
                d.className !== e && (d.className = e)
            }
            return this
        }, toggleClass: function (b, c) {
            var d = typeof b;
            return "boolean" == typeof c && "string" === d ? c ? this.addClass(b) : this.removeClass(b) : this.each(f.isFunction(b) ? function (d) {
                f(this).toggleClass(b.call(this, d, this.className, c), c)
            } : function () {
                if ("string" ===
                    d)for (var c, e = 0, h = f(this), l = b.match(W) || []; c = l[e++];)h.hasClass(c) ? h.removeClass(c) : h.addClass(c); else("undefined" === d || "boolean" === d) && (this.className && D.set(this, "__className__", this.className), this.className = this.className || !1 === b ? "" : D.get(this, "__className__") || "")
            })
        }, hasClass: function (b) {
            b = " " + b + " ";
            for (var c = 0, d = this.length; d > c; c++)if (1 === this[c].nodeType && 0 <= (" " + this[c].className + " ").replace(Ta, " ").indexOf(b))return !0;
            return !1
        }
    });
    var Ib = /\r/g;
    f.fn.extend({
        val: function (b) {
            var c, d, e, h = this[0];
            if (arguments.length)return e = f.isFunction(b), this.each(function (d) {
                var h;
                1 === this.nodeType && (h = e ? b.call(this, d, f(this).val()) : b, null == h ? h = "" : "number" == typeof h ? h += "" : f.isArray(h) && (h = f.map(h, function (b) {
                        return null == b ? "" : b + ""
                    })), c = f.valHooks[this.type] || f.valHooks[this.nodeName.toLowerCase()], c && "set" in c && void 0 !== c.set(this, h, "value") || (this.value = h))
            });
            if (h)return c = f.valHooks[h.type] || f.valHooks[h.nodeName.toLowerCase()], c && "get" in c && void 0 !== (d = c.get(h, "value")) ? d : (d = h.value, "string" == typeof d ?
                d.replace(Ib, "") : null == d ? "" : d)
        }
    });
    f.extend({
        valHooks: {
            option: {
                get: function (b) {
                    var c = f.find.attr(b, "value");
                    return null != c ? c : f.trim(f.text(b))
                }
            }, select: {
                get: function (b) {
                    for (var c, d = b.options, e = b.selectedIndex, h = "select-one" === b.type || 0 > e, l = h ? null : [], g = h ? e + 1 : d.length, q = 0 > e ? g : h ? e : 0; g > q; q++)if (c = d[q], !(!c.selected && q !== e || (N.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && f.nodeName(c.parentNode, "optgroup"))) {
                        if (b = f(c).val(), h)return b;
                        l.push(b)
                    }
                    return l
                }, set: function (b,
                                  c) {
                    for (var d, e, h = b.options, l = f.makeArray(c), g = h.length; g--;)e = h[g], (e.selected = 0 <= f.inArray(e.value, l)) && (d = !0);
                    return d || (b.selectedIndex = -1), l
                }
            }
        }
    });
    f.each(["radio", "checkbox"], function () {
        f.valHooks[this] = {
            set: function (b, c) {
                return f.isArray(c) ? b.checked = 0 <= f.inArray(f(b).val(), c) : void 0
            }
        };
        N.checkOn || (f.valHooks[this].get = function (b) {
            return null === b.getAttribute("value") ? "on" : b.value
        })
    });
    f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),
        function (b, c) {
            f.fn[c] = function (b, d) {
                return 0 < arguments.length ? this.on(c, null, b, d) : this.trigger(c)
            }
        });
    f.fn.extend({
        hover: function (b, c) {
            return this.mouseenter(b).mouseleave(c || b)
        }, bind: function (b, c, d) {
            return this.on(b, null, c, d)
        }, unbind: function (b, c) {
            return this.off(b, null, c)
        }, delegate: function (b, c, d, e) {
            return this.on(c, b, d, e)
        }, undelegate: function (b, c, d) {
            return 1 === arguments.length ? this.off(b, "**") : this.off(c, b || "**", d)
        }
    });
    var Ua = f.now(), Va = /\?/;
    f.parseJSON = function (b) {
        return JSON.parse(b + "")
    };
    f.parseXML =
        function (b) {
            var c, d;
            if (!b || "string" != typeof b)return null;
            try {
                d = new DOMParser, c = d.parseFromString(b, "text/xml")
            } catch (e) {
                c = void 0
            }
            return (!c || c.getElementsByTagName("parsererror").length) && f.error("Invalid XML: " + b), c
        };
    var ma, sa, Jb = /#.*$/, ib = /([?&])_=[^&]*/, Kb = /^(.*?):[ \t]*([^\r\n]*)$/gm, Lb = /^(?:GET|HEAD)$/,
        Mb = /^\/\//, jb = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, kb = {}, Ra = {},
        lb = "*/".concat("*");
    try {
        sa = location.href
    } catch (Ub) {
        sa = K.createElement("a"), sa.href = "", sa = sa.href
    }
    ma = jb.exec(sa.toLowerCase()) ||
        [];
    f.extend({
        active: 0, lastModified: {}, etag: {}, ajaxSettings: {
            url: sa,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(ma[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": lb,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /xml/, html: /html/, json: /json/},
            responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
            converters: {
                "* text": String,
                "text html": !0, "text json": f.parseJSON, "text xml": f.parseXML
            },
            flatOptions: {url: !0, context: !0}
        }, ajaxSetup: function (b, c) {
            return c ? wa(wa(b, f.ajaxSettings), c) : wa(f.ajaxSettings, b)
        }, ajaxPrefilter: J(kb), ajaxTransport: J(Ra), ajax: function (b, c) {
            function d(b, c, g, m) {
                var p, u, v, s, B = c;
                if (2 !== I) {
                    I = 2;
                    q && clearTimeout(q);
                    e = void 0;
                    l = m || "";
                    J.readyState = 0 < b ? 4 : 0;
                    m = 200 <= b && 300 > b || 304 === b;
                    if (g) {
                        v = r;
                        for (var A = J, w, S, aa, G, V = v.contents, R = v.dataTypes; "*" === R[0];)R.shift(), void 0 === w && (w = v.mimeType || A.getResponseHeader("Content-Type"));
                        if (w)for (S in V)if (V[S] && V[S].test(w)) {
                            R.unshift(S);
                            break
                        }
                        if (R[0] in g) aa = R[0]; else {
                            for (S in g) {
                                if (!R[0] || v.converters[S + " " + R[0]]) {
                                    aa = S;
                                    break
                                }
                                G || (G = S)
                            }
                            aa = aa || G
                        }
                        v = aa ? (aa !== R[0] && R.unshift(aa), g[aa]) : void 0
                    }
                    var fa;
                    a:{
                        g = r;
                        w = v;
                        S = J;
                        aa = m;
                        var F, t, L;
                        v = {};
                        A = g.dataTypes.slice();
                        if (A[1])for (F in g.converters)v[F.toLowerCase()] = g.converters[F];
                        for (G = A.shift(); G;)if (g.responseFields[G] && (S[g.responseFields[G]] = w), !L && aa && g.dataFilter && (w = g.dataFilter(w, g.dataType)), L = G, G = A.shift())if ("*" === G) G = L; else if ("*" !==
                            L && L !== G) {
                            if (F = v[L + " " + G] || v["* " + G], !F)for (fa in v)if (t = fa.split(" "), t[1] === G && (F = v[L + " " + t[0]] || v["* " + t[0]])) {
                                !0 === F ? F = v[fa] : !0 !== v[fa] && (G = t[0], A.unshift(t[1]));
                                break
                            }
                            if (!0 !== F)if (F && g["throws"]) w = F(w); else try {
                                w = F(w)
                            } catch (C) {
                                fa = {state: "parsererror", error: F ? C : "No conversion from " + L + " to " + G};
                                break a
                            }
                        }
                        fa = {state: "success", data: w}
                    }
                    v = fa;
                    m ? (r.ifModified && (s = J.getResponseHeader("Last-Modified"), s && (f.lastModified[h] = s), s = J.getResponseHeader("etag"), s && (f.etag[h] = s)), 204 === b || "HEAD" === r.type ? B = "nocontent" :
                        304 === b ? B = "notmodified" : (B = v.state, p = v.data, u = v.error, m = !u)) : (u = B, (b || !B) && (B = "error", 0 > b && (b = 0)));
                    J.status = b;
                    J.statusText = (c || B) + "";
                    m ? O.resolveWith(E, [p, B, J]) : O.rejectWith(E, [J, B, u]);
                    J.statusCode(x);
                    x = void 0;
                    k && n.trigger(m ? "ajaxSuccess" : "ajaxError", [J, r, m ? p : u]);
                    M.fireWith(E, [J, B]);
                    k && (n.trigger("ajaxComplete", [J, r]), --f.active || f.event.trigger("ajaxStop"))
                }
            }

            "object" == typeof b && (c = b, b = void 0);
            c = c || {};
            var e, h, l, g, q, u, k, v, r = f.ajaxSetup({}, c), E = r.context || r,
                n = r.context && (E.nodeType || E.jquery) ? f(E) : f.event,
                O = f.Deferred(), M = f.Callbacks("once memory"), x = r.statusCode || {}, s = {}, B = {}, I = 0,
                w = "canceled", J = {
                    readyState: 0, getResponseHeader: function (b) {
                        var c;
                        if (2 === I) {
                            if (!g)for (g = {}; c = Kb.exec(l);)g[c[1].toLowerCase()] = c[2];
                            c = g[b.toLowerCase()]
                        }
                        return null == c ? null : c
                    }, getAllResponseHeaders: function () {
                        return 2 === I ? l : null
                    }, setRequestHeader: function (b, c) {
                        var d = b.toLowerCase();
                        return I || (b = B[d] = B[d] || b, s[b] = c), this
                    }, overrideMimeType: function (b) {
                        return I || (r.mimeType = b), this
                    }, statusCode: function (b) {
                        var c;
                        if (b)if (2 > I)for (c in b)x[c] =
                            [x[c], b[c]]; else J.always(b[J.status]);
                        return this
                    }, abort: function (b) {
                        b = b || w;
                        return e && e.abort(b), d(0, b), this
                    }
                };
            if (O.promise(J).complete = M.add, J.success = J.done, J.error = J.fail, r.url = ((b || r.url || sa) + "").replace(Jb, "").replace(Mb, ma[1] + "//"), r.type = c.method || c.type || r.method || r.type, r.dataTypes = f.trim(r.dataType || "*").toLowerCase().match(W) || [""], null == r.crossDomain && (u = jb.exec(r.url.toLowerCase()), r.crossDomain = !(!u || u[1] === ma[1] && u[2] === ma[2] && (u[3] || ("http:" === u[1] ? "80" : "443")) === (ma[3] || ("http:" ===
                ma[1] ? "80" : "443")))), r.data && r.processData && "string" != typeof r.data && (r.data = f.param(r.data, r.traditional)), da(kb, r, c, J), 2 === I)return J;
            (k = r.global) && 0 === f.active++ && f.event.trigger("ajaxStart");
            r.type = r.type.toUpperCase();
            r.hasContent = !Lb.test(r.type);
            h = r.url;
            r.hasContent || (r.data && (h = r.url += (Va.test(h) ? "&" : "?") + r.data, delete r.data), !1 === r.cache && (r.url = ib.test(h) ? h.replace(ib, "$1_=" + Ua++) : h + (Va.test(h) ? "&" : "?") + "_=" + Ua++));
            r.ifModified && (f.lastModified[h] && J.setRequestHeader("If-Modified-Since",
                f.lastModified[h]), f.etag[h] && J.setRequestHeader("If-None-Match", f.etag[h]));
            (r.data && r.hasContent && !1 !== r.contentType || c.contentType) && J.setRequestHeader("Content-Type", r.contentType);
            J.setRequestHeader("Accept", r.dataTypes[0] && r.accepts[r.dataTypes[0]] ? r.accepts[r.dataTypes[0]] + ("*" !== r.dataTypes[0] ? ", " + lb + "; q=0.01" : "") : r.accepts["*"]);
            for (v in r.headers)J.setRequestHeader(v, r.headers[v]);
            if (r.beforeSend && (!1 === r.beforeSend.call(E, J, r) || 2 === I))return J.abort();
            w = "abort";
            for (v in{
                success: 1, error: 1,
                complete: 1
            })J[v](r[v]);
            if (e = da(Ra, r, c, J)) {
                J.readyState = 1;
                k && n.trigger("ajaxSend", [J, r]);
                r.async && 0 < r.timeout && (q = setTimeout(function () {
                    J.abort("timeout")
                }, r.timeout));
                try {
                    I = 1, e.send(s, d)
                } catch (S) {
                    if (!(2 > I))throw S;
                    d(-1, S)
                }
            } else d(-1, "No Transport");
            return J
        }, getJSON: function (b, c, d) {
            return f.get(b, c, d, "json")
        }, getScript: function (b, c) {
            return f.get(b, void 0, c, "script")
        }
    });
    f.each(["get", "post"], function (b, c) {
        f[c] = function (b, d, e, h) {
            return f.isFunction(d) && (h = h || e, e = d, d = void 0), f.ajax({
                url: b, type: c, dataType: h,
                data: d, success: e
            })
        }
    });
    f.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function (b, c) {
        f.fn[c] = function (b) {
            return this.on(c, b)
        }
    });
    f._evalUrl = function (b) {
        return f.ajax({url: b, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0})
    };
    f.fn.extend({
        wrapAll: function (b) {
            var c;
            return f.isFunction(b) ? this.each(function (c) {
                f(this).wrapAll(b.call(this, c))
            }) : (this[0] && (c = f(b, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && c.insertBefore(this[0]), c.map(function () {
                for (var b =
                    this; b.firstElementChild;)b = b.firstElementChild;
                return b
            }).append(this)), this)
        }, wrapInner: function (b) {
            return this.each(f.isFunction(b) ? function (c) {
                f(this).wrapInner(b.call(this, c))
            } : function () {
                var c = f(this), d = c.contents();
                d.length ? d.wrapAll(b) : c.append(b)
            })
        }, wrap: function (b) {
            var c = f.isFunction(b);
            return this.each(function (d) {
                f(this).wrapAll(c ? b.call(this, d) : b)
            })
        }, unwrap: function () {
            return this.parent().each(function () {
                f.nodeName(this, "body") || f(this).replaceWith(this.childNodes)
            }).end()
        }
    });
    f.expr.filters.hidden =
        function (b) {
            return 0 >= b.offsetWidth && 0 >= b.offsetHeight
        };
    f.expr.filters.visible = function (b) {
        return !f.expr.filters.hidden(b)
    };
    var Nb = /%20/g, ub = /\[\]$/, mb = /\r?\n/g, Ob = /^(?:submit|button|image|reset|file)$/i,
        Pb = /^(?:input|select|textarea|keygen)/i;
    f.param = function (b, c) {
        var d, e = [], h = function (b, c) {
            c = f.isFunction(c) ? c() : null == c ? "" : c;
            e[e.length] = encodeURIComponent(b) + "=" + encodeURIComponent(c)
        };
        if (void 0 === c && (c = f.ajaxSettings && f.ajaxSettings.traditional), f.isArray(b) || b.jquery && !f.isPlainObject(b)) f.each(b,
            function () {
                h(this.name, this.value)
            }); else for (d in b)ia(d, b[d], c, h);
        return e.join("&").replace(Nb, "+")
    };
    f.fn.extend({
        serialize: function () {
            return f.param(this.serializeArray())
        }, serializeArray: function () {
            return this.map(function () {
                var b = f.prop(this, "elements");
                return b ? f.makeArray(b) : this
            }).filter(function () {
                var b = this.type;
                return this.name && !f(this).is(":disabled") && Pb.test(this.nodeName) && !Ob.test(b) && (this.checked || !$a.test(b))
            }).map(function (b, c) {
                var d = f(this).val();
                return null == d ? null : f.isArray(d) ?
                    f.map(d, function (b) {
                        return {name: c.name, value: b.replace(mb, "\r\n")}
                    }) : {name: c.name, value: d.replace(mb, "\r\n")}
            }).get()
        }
    });
    f.ajaxSettings.xhr = function () {
        try {
            return new XMLHttpRequest
        } catch (b) {
        }
    };
    var Qb = 0, Pa = {}, Rb = {0: 200, 1223: 204}, Ga = f.ajaxSettings.xhr();
    d.ActiveXObject && f(d).on("unload", function () {
        for (var b in Pa)Pa[b]()
    });
    N.cors = !!Ga && "withCredentials" in Ga;
    N.ajax = Ga = !!Ga;
    f.ajaxTransport(function (b) {
        var c;
        return N.cors || Ga && !b.crossDomain ? {
            send: function (d, e) {
                var f, h = b.xhr(), l = ++Qb;
                if (h.open(b.type,
                        b.url, b.async, b.username, b.password), b.xhrFields)for (f in b.xhrFields)h[f] = b.xhrFields[f];
                b.mimeType && h.overrideMimeType && h.overrideMimeType(b.mimeType);
                b.crossDomain || d["X-Requested-With"] || (d["X-Requested-With"] = "XMLHttpRequest");
                for (f in d)h.setRequestHeader(f, d[f]);
                c = function (b) {
                    return function () {
                        c && (delete Pa[l], c = h.onload = h.onerror = null, "abort" === b ? h.abort() : "error" === b ? e(h.status, h.statusText) : e(Rb[h.status] || h.status, h.statusText, "string" == typeof h.responseText ? {text: h.responseText} : void 0,
                            h.getAllResponseHeaders()))
                    }
                };
                h.onload = c();
                h.onerror = c("error");
                c = Pa[l] = c("abort");
                try {
                    h.send(b.hasContent && b.data || null)
                } catch (g) {
                    if (c)throw g;
                }
            }, abort: function () {
                c && c()
            }
        } : void 0
    });
    f.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /(?:java|ecma)script/},
        converters: {
            "text script": function (b) {
                return f.globalEval(b), b
            }
        }
    });
    f.ajaxPrefilter("script", function (b) {
        void 0 === b.cache && (b.cache = !1);
        b.crossDomain && (b.type =
            "GET")
    });
    f.ajaxTransport("script", function (b) {
        if (b.crossDomain) {
            var c, d;
            return {
                send: function (e, h) {
                    c = f("<script>").prop({
                        async: !0,
                        charset: b.scriptCharset,
                        src: b.url
                    }).on("load error", d = function (b) {
                        c.remove();
                        d = null;
                        b && h("error" === b.type ? 404 : 200, b.type)
                    });
                    K.head.appendChild(c[0])
                }, abort: function () {
                    d && d()
                }
            }
        }
    });
    var nb = [], Wa = /(=)\?(?=&|$)|\?\?/;
    f.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var b = nb.pop() || f.expando + "_" + Ua++;
            return this[b] = !0, b
        }
    });
    f.ajaxPrefilter("json jsonp", function (b, c, e) {
        var h,
            l, g,
            q = !1 !== b.jsonp && (Wa.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && Wa.test(b.data) && "data");
        return q || "jsonp" === b.dataTypes[0] ? (h = b.jsonpCallback = f.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, q ? b[q] = b[q].replace(Wa, "$1" + h) : !1 !== b.jsonp && (b.url += (Va.test(b.url) ? "&" : "?") + b.jsonp + "=" + h), b.converters["script json"] = function () {
            return g || f.error(h + " was not called"), g[0]
        }, b.dataTypes[0] = "json", l = d[h], d[h] = function () {
            g =
                arguments
        }, e.always(function () {
            d[h] = l;
            b[h] && (b.jsonpCallback = c.jsonpCallback, nb.push(h));
            g && f.isFunction(l) && l(g[0]);
            g = l = void 0
        }), "script") : void 0
    });
    f.parseHTML = function (b, c, d) {
        if (!b || "string" != typeof b)return null;
        "boolean" == typeof c && (d = c, c = !1);
        c = c || K;
        var e = u.exec(b);
        d = !d && [];
        return e ? [c.createElement(e[1])] : (e = f.buildFragment([b], c, d), d && d.length && f(d).remove(), f.merge([], e.childNodes))
    };
    var ob = f.fn.load;
    f.fn.load = function (b, c, d) {
        if ("string" != typeof b && ob)return ob.apply(this, arguments);
        var e,
            h, l, g = this, q = b.indexOf(" ");
        return 0 <= q && (e = f.trim(b.slice(q)), b = b.slice(0, q)), f.isFunction(c) ? (d = c, c = void 0) : c && "object" == typeof c && (h = "POST"), 0 < g.length && f.ajax({
            url: b,
            type: h,
            dataType: "html",
            data: c
        }).done(function (b) {
            l = arguments;
            g.html(e ? f("<div>").append(f.parseHTML(b)).find(e) : b)
        }).complete(d && function (b, c) {
                g.each(d, l || [b.responseText, c, b])
            }), this
    };
    f.expr.filters.animated = function (b) {
        return f.grep(f.timers, function (c) {
            return b === c.elem
        }).length
    };
    var pb = d.document.documentElement;
    f.offset = {
        setOffset: function (b,
                             c, d) {
            var e, h, l, g, q, u, k = f.css(b, "position"), r = f(b), v = {};
            "static" === k && (b.style.position = "relative");
            q = r.offset();
            l = f.css(b, "top");
            u = f.css(b, "left");
            ("absolute" === k || "fixed" === k) && -1 < (l + u).indexOf("auto") ? (e = r.position(), g = e.top, h = e.left) : (g = parseFloat(l) || 0, h = parseFloat(u) || 0);
            f.isFunction(c) && (c = c.call(b, d, q));
            null != c.top && (v.top = c.top - q.top + g);
            null != c.left && (v.left = c.left - q.left + h);
            "using" in c ? c.using.call(b, v) : r.css(v)
        }
    };
    f.fn.extend({
        offset: function (b) {
            if (arguments.length)return void 0 === b ? this :
                this.each(function (c) {
                    f.offset.setOffset(this, b, c)
                });
            var c, d, e = this[0], h = {top: 0, left: 0}, l = e && e.ownerDocument;
            if (l)return c = l.documentElement, f.contains(c, e) ? ("undefined" !== typeof e.getBoundingClientRect && (h = e.getBoundingClientRect()), d = Ca(l), {
                top: h.top + d.pageYOffset - c.clientTop,
                left: h.left + d.pageXOffset - c.clientLeft
            }) : h
        }, position: function () {
            if (this[0]) {
                var b, c, d = this[0], e = {top: 0, left: 0};
                return "fixed" === f.css(d, "position") ? c = d.getBoundingClientRect() : (b = this.offsetParent(), c = this.offset(), f.nodeName(b[0],
                    "html") || (e = b.offset()), e.top += f.css(b[0], "borderTopWidth", !0), e.left += f.css(b[0], "borderLeftWidth", !0)), {
                    top: c.top - e.top - f.css(d, "marginTop", !0),
                    left: c.left - e.left - f.css(d, "marginLeft", !0)
                }
            }
        }, offsetParent: function () {
            return this.map(function () {
                for (var b = this.offsetParent || pb; b && !f.nodeName(b, "html") && "static" === f.css(b, "position");)b = b.offsetParent;
                return b || pb
            })
        }
    });
    f.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (b, c) {
        var e = "pageYOffset" === c;
        f.fn[b] = function (h) {
            return ra(this, function (b,
                                      h, f) {
                var l = Ca(b);
                return void 0 === f ? l ? l[c] : b[h] : void(l ? l.scrollTo(e ? d.pageXOffset : f, e ? f : d.pageYOffset) : b[h] = f)
            }, b, h, arguments.length, null)
        }
    });
    f.each(["top", "left"], function (b, c) {
        f.cssHooks[c] = V(N.pixelPosition, function (b, d) {
            return d ? (d = I(b, c), Qa.test(d) ? f(b).position()[c] + "px" : d) : void 0
        })
    });
    f.each({Height: "height", Width: "width"}, function (b, c) {
        f.each({padding: "inner" + b, content: c, "": "outer" + b}, function (d, e) {
            f.fn[e] = function (e, h) {
                var l = arguments.length && (d || "boolean" != typeof e), g = d || (!0 === e || !0 === h ? "margin" :
                        "border");
                return ra(this, function (c, d, e) {
                    var h;
                    return f.isWindow(c) ? c.document.documentElement["client" + b] : 9 === c.nodeType ? (h = c.documentElement, Math.max(c.body["scroll" + b], h["scroll" + b], c.body["offset" + b], h["offset" + b], h["client" + b])) : void 0 === e ? f.css(c, d, g) : f.style(c, d, e, g)
                }, c, l ? e : void 0, l, null)
            }
        })
    });
    f.fn.size = function () {
        return this.length
    };
    f.fn.andSelf = f.fn.addBack;
    "function" == typeof define && define.amd && define("jquery", [], function () {
        return f
    });
    var Sb = d.jQuery, Tb = d.$;
    return f.noConflict = function (b) {
        return d.$ ===
        f && (d.$ = Tb), b && d.jQuery === f && (d.jQuery = Sb), f
    }, "undefined" === typeof n && (d.jQuery = d.$ = f), f
});
!function (d) {
    function n(b, c) {
        return function (d) {
            return s(b.call(this, d), c)
        }
    }

    function t(b, c) {
        return function (d) {
            return this.lang().ordinal(b.call(this, d), c)
        }
    }

    function c() {
    }

    function e(b) {
        k(this, b)
    }

    function g(b) {
        var c = b.years || b.year || b.y || 0, d = b.months || b.month || b.M || 0, e = b.weeks || b.week || b.w || 0,
            f = b.days || b.day || b.d || 0, l = b.hours || b.hour || b.h || 0, g = b.minutes || b.minute || b.m || 0,
            q = b.seconds || b.second || b.s || 0, k = b.milliseconds || b.millisecond || b.ms || 0;
        this._input = b;
        this._milliseconds = k + 1E3 * q + 6E4 * g + 36E5 * l;
        this._days =
            f + 7 * e;
        this._months = d + 12 * c;
        this._data = {};
        this._bubble()
    }

    function k(b, c) {
        for (var d in c)c.hasOwnProperty(d) && (b[d] = c[d]);
        return b
    }

    function x(b) {
        return 0 > b ? Math.ceil(b) : Math.floor(b)
    }

    function s(b, c) {
        for (var d = b + ""; d.length < c;)d = "0" + d;
        return d
    }

    function G(b, c, d, e) {
        var f, l, g = c._milliseconds, q = c._days;
        c = c._months;
        g && b._d.setTime(+b._d + g * d);
        (q || c) && (f = b.minute(), l = b.hour());
        q && b.date(b.date() + q * d);
        c && b.month(b.month() + c * d);
        g && !e && r.updateOffset(b);
        (q || c) && (b.minute(f), b.hour(l))
    }

    function C(b, c) {
        var d, e = Math.min(b.length,
            c.length), f = Math.abs(b.length - c.length), l = 0;
        for (d = 0; e > d; d++)~~b[d] !== ~~c[d] && l++;
        return l + f
    }

    function H(b) {
        return b ? Aa[b] || b.toLowerCase().replace(/(.)s$/, "$1") : b
    }

    function P(b) {
        if (!b)return r.fn._lang;
        if (!l[b] && v)try {
            require("./lang/" + b)
        } catch (c) {
            return r.fn._lang
        }
        return l[b]
    }

    function T(b) {
        return b.match(/\[.*\]/) ? b.replace(/^\[|\]$/g, "") : b.replace(/\\/g, "")
    }

    function ea(b) {
        var c, d, e = b.match(J);
        c = 0;
        for (d = e.length; d > c; c++)e[c] = Y[e[c]] ? Y[e[c]] : T(e[c]);
        return function (f) {
            var l = "";
            for (c = 0; d > c; c++)l += e[c] instanceof
            Function ? e[c].call(f, b) : e[c];
            return l
        }
    }

    function ca(b, c) {
        function d(c) {
            return b.lang().longDateFormat(c) || c
        }

        for (var e = 5; e-- && da.test(c);)c = c.replace(da, d);
        return pa[c] || (pa[c] = ea(c)), pa[c](b)
    }

    function w(b, c) {
        switch (b) {
            case "DDDD":
                return Ca;
            case "YYYY":
                return na;
            case "YYYYY":
                return ja;
            case "S":
            case "SS":
            case "SSS":
            case "DDD":
                return ia;
            case "MMM":
            case "MMMM":
            case "dd":
            case "ddd":
            case "dddd":
                return la;
            case "a":
            case "A":
                return P(c._l)._meridiemParse;
            case "X":
                return Q;
            case "Z":
            case "ZZ":
                return M;
            case "T":
                return S;
            case "MM":
            case "DD":
            case "YY":
            case "HH":
            case "hh":
            case "mm":
            case "ss":
            case "M":
            case "D":
            case "d":
            case "H":
            case "h":
            case "m":
            case "s":
                return wa;
            default:
                return new RegExp(b.replace("\\", ""))
        }
    }

    function F(b) {
        b = ((M.exec(b) || [])[0] + "").match(N) || ["-", 0, 0];
        var c = +(60 * b[1]) + ~~b[2];
        return "+" === b[0] ? -c : c
    }

    function B(b) {
        var c, d = [];
        if (!b._d) {
            for (c = 0; 7 > c; c++)b._a[c] = d[c] = null == b._a[c] ? 2 === c ? 1 : 0 : b._a[c];
            d[3] += ~~((b._tzm || 0) / 60);
            d[4] += ~~((b._tzm || 0) % 60);
            c = new Date(0);
            b._useUTC ? (c.setUTCFullYear(d[0], d[1], d[2]), c.setUTCHours(d[3],
                d[4], d[5], d[6])) : (c.setFullYear(d[0], d[1], d[2]), c.setHours(d[3], d[4], d[5], d[6]));
            b._d = c
        }
    }

    function q(b) {
        var c, d, e = b._f.match(J), f = b._i;
        b._a = [];
        for (c = 0; c < e.length; c++)if ((d = (w(e[c], b).exec(f) || [])[0]) && (f = f.slice(f.indexOf(d) + d.length)), Y[e[c]]) {
            var l = b, g = void 0, q = l._a;
            switch (e[c]) {
                case "M":
                case "MM":
                    q[1] = null == d ? 0 : ~~d - 1;
                    break;
                case "MMM":
                case "MMMM":
                    g = P(l._l).monthsParse(d);
                    null != g ? q[1] = g : l._isValid = !1;
                    break;
                case "D":
                case "DD":
                case "DDD":
                case "DDDD":
                    null != d && (q[2] = ~~d);
                    break;
                case "YY":
                    q[0] = ~~d + (68 <
                        ~~d ? 1900 : 2E3);
                    break;
                case "YYYY":
                case "YYYYY":
                    q[0] = ~~d;
                    break;
                case "a":
                case "A":
                    l._isPm = P(l._l).isPM(d);
                    break;
                case "H":
                case "HH":
                case "h":
                case "hh":
                    q[3] = ~~d;
                    break;
                case "m":
                case "mm":
                    q[4] = ~~d;
                    break;
                case "s":
                case "ss":
                    q[5] = ~~d;
                    break;
                case "S":
                case "SS":
                case "SSS":
                    q[6] = ~~(1E3 * ("0." + d));
                    break;
                case "X":
                    l._d = new Date(1E3 * parseFloat(d));
                    break;
                case "Z":
                case "ZZ":
                    l._useUTC = !0, l._tzm = F(d)
            }
            null == d && (l._isValid = !1)
        }
        f && (b._il = f);
        b._isPm && 12 > b._a[3] && (b._a[3] += 12);
        !1 === b._isPm && 12 === b._a[3] && (b._a[3] = 0);
        B(b)
    }

    function I(b,
               c, d, e, f) {
        return f.relativeTime(c || 1, !!d, b, e)
    }

    function V(b, c, d) {
        var e;
        c = d - c;
        d -= b.day();
        return d > c && (d -= 7), c - 7 > d && (d += 7), e = r(b).add("d", d), {
            week: Math.ceil(e.dayOfYear() / 7),
            year: e.year()
        }
    }

    function L(b) {
        var c = b._i, f = b._f;
        if (null === c || "" === c) b = null; else {
            "string" == typeof c && (b._i = c = P().preparse(c));
            if (r.isMoment(c)) b = k({}, c), b._d = new Date(+c._d); else if (f)if ("[object Array]" === Object.prototype.toString.call(f)) {
                var c = b, l, g, v, n = 99;
                for (v = 0; v < c._f.length; v++)l = k({}, c), l._f = c._f[v], q(l), f = new e(l), l = C(l._a,
                    f.toArray()), f._il && (l += f._il.length), n > l && (n = l, g = f);
                k(c, g)
            } else q(b); else if (g = b, c = g._i, f = O.exec(c), c === d) g._d = new Date; else if (f) g._d = new Date(+f[1]); else if ("string" == typeof c)if (c = g._i, f = Ea.exec(c)) {
                g._f = "YYYY-MM-DD" + (f[2] || " ");
                for (f = 0; 4 > f; f++)if (oa[f][1].exec(c)) {
                    g._f += oa[f][0];
                    break
                }
                M.exec(c) && (g._f += " Z");
                q(g)
            } else g._d = new Date(c); else"[object Array]" === Object.prototype.toString.call(c) ? (g._a = c.slice(0), B(g)) : g._d = c instanceof Date ? new Date(+c) : new Date(c);
            b = new e(b)
        }
        return b
    }

    function za(b,
                c) {
        r.fn[b] = r.fn[b + "s"] = function (b) {
            var d = this._isUTC ? "UTC" : "";
            return null != b ? (this._d["set" + d + c](b), r.updateOffset(this), this) : this._d["get" + d + c]()
        }
    }

    function b(b) {
        r.duration.fn[b] = function () {
            return this._data[b]
        }
    }

    function ka(b, c) {
        r.duration.fn["as" + b] = function () {
            return +this / c
        }
    }

    for (var r, z, ga = Math.round, l = {}, v = "undefined" != typeof module && module.exports, O = /^\/?Date\((\-?\d+)/i, aa = /(\-)?(\d*)?\.?(\d+)\:(\d+)\:(\d+)\.?(\d{3})?/, J = /(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|SS?S?|X|zz?|ZZ?|.)/g,
             da = /(\[[^\[]*\])|(\\)?(LT|LL?L?L?|l{1,4})/g, wa = /\d\d?/, ia = /\d{1,3}/, Ca = /\d{3}/, na = /\d{1,4}/, ja = /[+\-]?\d{1,6}/, la = /[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i, M = /Z|[\+\-]\d\d:?\d\d/i, S = /T/i, Q = /[\+\-]?\d+(\.\d{1,3})?/, Ea = /^\s*\d{4}-\d\d-\d\d((T| )(\d\d(:\d\d(:\d\d(\.\d\d?\d?)?)?)?)?([\+\-]\d\d:?\d\d)?)?/, oa = [["HH:mm:ss.S", /(T| )\d\d:\d\d:\d\d\.\d{1,3}/], ["HH:mm:ss", /(T| )\d\d:\d\d:\d\d/], ["HH:mm", /(T| )\d\d:\d\d/], ["HH", /(T| )\d\d/]],
             N = /([\+\-]|\d\d)/gi, K = ["Date", "Hours", "Minutes", "Seconds", "Milliseconds"], f = {
            Milliseconds: 1,
            Seconds: 1E3,
            Minutes: 6E4,
            Hours: 36E5,
            Days: 864E5,
            Months: 2592E6,
            Years: 31536E6
        }, Aa = {
            ms: "millisecond",
            s: "second",
            m: "minute",
            h: "hour",
            d: "day",
            w: "week",
            M: "month",
            y: "year"
        }, pa = {}, Ka = "DDD w W M D d".split(" "), La = "MDHhmswW".split(""), Y = {
            M: function () {
                return this.month() + 1
            }, MMM: function (b) {
                return this.lang().monthsShort(this, b)
            }, MMMM: function (b) {
                return this.lang().months(this, b)
            }, D: function () {
                return this.date()
            }, DDD: function () {
                return this.dayOfYear()
            },
            d: function () {
                return this.day()
            }, dd: function (b) {
                return this.lang().weekdaysMin(this, b)
            }, ddd: function (b) {
                return this.lang().weekdaysShort(this, b)
            }, dddd: function (b) {
                return this.lang().weekdays(this, b)
            }, w: function () {
                return this.week()
            }, W: function () {
                return this.isoWeek()
            }, YY: function () {
                return s(this.year() % 100, 2)
            }, YYYY: function () {
                return s(this.year(), 4)
            }, YYYYY: function () {
                return s(this.year(), 5)
            }, gg: function () {
                return s(this.weekYear() % 100, 2)
            }, gggg: function () {
                return this.weekYear()
            }, ggggg: function () {
                return s(this.weekYear(),
                    5)
            }, GG: function () {
                return s(this.isoWeekYear() % 100, 2)
            }, GGGG: function () {
                return this.isoWeekYear()
            }, GGGGG: function () {
                return s(this.isoWeekYear(), 5)
            }, e: function () {
                return this.weekday()
            }, E: function () {
                return this.isoWeekday()
            }, a: function () {
                return this.lang().meridiem(this.hours(), this.minutes(), !0)
            }, A: function () {
                return this.lang().meridiem(this.hours(), this.minutes(), !1)
            }, H: function () {
                return this.hours()
            }, h: function () {
                return this.hours() % 12 || 12
            }, m: function () {
                return this.minutes()
            }, s: function () {
                return this.seconds()
            },
            S: function () {
                return ~~(this.milliseconds() / 100)
            }, SS: function () {
                return s(~~(this.milliseconds() / 10), 2)
            }, SSS: function () {
                return s(this.milliseconds(), 3)
            }, Z: function () {
                var b = -this.zone(), c = "+";
                return 0 > b && (b = -b, c = "-"), c + s(~~(b / 60), 2) + ":" + s(~~b % 60, 2)
            }, ZZ: function () {
                var b = -this.zone(), c = "+";
                return 0 > b && (b = -b, c = "-"), c + s(~~(10 * b / 6), 4)
            }, z: function () {
                return this.zoneAbbr()
            }, zz: function () {
                return this.zoneName()
            }, X: function () {
                return this.unix()
            }
        }; Ka.length;)z = Ka.pop(), Y[z + "o"] = t(Y[z], z);
    for (; La.length;)z = La.pop(),
        Y[z + z] = n(Y[z], 2);
    Y.DDDD = n(Y.DDD, 3);
    c.prototype = {
        set: function (b) {
            var c, d;
            for (d in b)c = b[d], "function" == typeof c ? this[d] = c : this["_" + d] = c
        },
        _months: "January February March April May June July August September October November December".split(" "),
        months: function (b) {
            return this._months[b.month()]
        },
        _monthsShort: "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" "),
        monthsShort: function (b) {
            return this._monthsShort[b.month()]
        },
        monthsParse: function (b) {
            var c, d, e;
            this._monthsParse || (this._monthsParse =
                []);
            for (c = 0; 12 > c; c++)if (this._monthsParse[c] || (d = r([2E3, c]), e = "^" + this.months(d, "") + "|^" + this.monthsShort(d, ""), this._monthsParse[c] = new RegExp(e.replace(".", ""), "i")), this._monthsParse[c].test(b))return c
        },
        _weekdays: "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),
        weekdays: function (b) {
            return this._weekdays[b.day()]
        },
        _weekdaysShort: "Sun Mon Tue Wed Thu Fri Sat".split(" "),
        weekdaysShort: function (b) {
            return this._weekdaysShort[b.day()]
        },
        _weekdaysMin: "Su Mo Tu We Th Fr Sa".split(" "),
        weekdaysMin: function (b) {
            return this._weekdaysMin[b.day()]
        },
        weekdaysParse: function (b) {
            var c, d, e;
            this._weekdaysParse || (this._weekdaysParse = []);
            for (c = 0; 7 > c; c++)if (this._weekdaysParse[c] || (d = r([2E3, 1]).day(c), e = "^" + this.weekdays(d, "") + "|^" + this.weekdaysShort(d, "") + "|^" + this.weekdaysMin(d, ""), this._weekdaysParse[c] = new RegExp(e.replace(".", ""), "i")), this._weekdaysParse[c].test(b))return c
        },
        _longDateFormat: {
            LT: "h:mm A",
            L: "MM/DD/YYYY",
            LL: "MMMM D YYYY",
            LLL: "MMMM D YYYY LT",
            LLLL: "dddd, MMMM D YYYY LT"
        },
        longDateFormat: function (b) {
            var c =
                this._longDateFormat[b];
            return !c && this._longDateFormat[b.toUpperCase()] && (c = this._longDateFormat[b.toUpperCase()].replace(/MMMM|MM|DD|dddd/g, function (b) {
                return b.slice(1)
            }), this._longDateFormat[b] = c), c
        },
        isPM: function (b) {
            return "p" === (b + "").toLowerCase()[0]
        },
        _meridiemParse: /[ap]\.?m?\.?/i,
        meridiem: function (b, c, d) {
            return 11 < b ? d ? "pm" : "PM" : d ? "am" : "AM"
        },
        _calendar: {
            sameDay: "[Today at] LT",
            nextDay: "[Tomorrow at] LT",
            nextWeek: "dddd [at] LT",
            lastDay: "[Yesterday at] LT",
            lastWeek: "[Last] dddd [at] LT",
            sameElse: "L"
        },
        calendar: function (b, c) {
            var d = this._calendar[b];
            return "function" == typeof d ? d.apply(c) : d
        },
        _relativeTime: {
            future: "in %s",
            past: "%s ago",
            s: "a few seconds",
            m: "a minute",
            mm: "%d minutes",
            h: "an hour",
            hh: "%d hours",
            d: "a day",
            dd: "%d days",
            M: "a month",
            MM: "%d months",
            y: "a year",
            yy: "%d years"
        },
        relativeTime: function (b, c, d, e) {
            var f = this._relativeTime[d];
            return "function" == typeof f ? f(b, c, d, e) : f.replace(/%d/i, b)
        },
        pastFuture: function (b, c) {
            var d = this._relativeTime[0 < b ? "future" : "past"];
            return "function" == typeof d ? d(c) :
                d.replace(/%s/i, c)
        },
        ordinal: function (b) {
            return this._ordinal.replace("%d", b)
        },
        _ordinal: "%d",
        preparse: function (b) {
            return b
        },
        postformat: function (b) {
            return b
        },
        week: function (b) {
            return V(b, this._week.dow, this._week.doy).week
        },
        _week: {dow: 0, doy: 6}
    };
    r = function (b, c, d) {
        return L({_i: b, _f: c, _l: d, _isUTC: !1})
    };
    r.utc = function (b, c, d) {
        return L({_useUTC: !0, _isUTC: !0, _l: d, _i: b, _f: c})
    };
    r.unix = function (b) {
        return r(1E3 * b)
    };
    r.duration = function (b, c) {
        var d, e, f = r.isDuration(b), l = "number" == typeof b, q = f ? b._input : l ? {} : b, k = aa.exec(b);
        return l ? c ? q[c] = b : q.milliseconds = b : k && (d = "-" === k[1] ? -1 : 1, q = {
                y: 0,
                d: ~~k[2] * d,
                h: ~~k[3] * d,
                m: ~~k[4] * d,
                s: ~~k[5] * d,
                ms: ~~k[6] * d
            }), e = new g(q), f && b.hasOwnProperty("_lang") && (e._lang = b._lang), e
    };
    r.version = "2.1.0";
    r.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ";
    r.updateOffset = function () {
    };
    r.lang = function (b, d) {
        var e;
        b ? (d ? (d.abbr = b, l[b] || (l[b] = new c), l[b].set(d)) : l[b] || P(b), e = (r.duration.fn._lang = r.fn._lang = P(b), void 0)) : e = r.fn._lang._abbr;
        return e
    };
    r.langData = function (b) {
        return b && b._lang && b._lang._abbr && (b = b._lang._abbr),
            P(b)
    };
    r.isMoment = function (b) {
        return b instanceof e
    };
    r.isDuration = function (b) {
        return b instanceof g
    };
    r.fn = e.prototype = {
        clone: function () {
            return r(this)
        }, valueOf: function () {
            return +this._d + 6E4 * (this._offset || 0)
        }, unix: function () {
            return Math.floor(+this / 1E3)
        }, toString: function () {
            return this.format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
        }, toDate: function () {
            return this._offset ? new Date(+this) : this._d
        }, toISOString: function () {
            return ca(r(this).utc(), "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]")
        }, toArray: function () {
            return [this.year(),
                this.month(), this.date(), this.hours(), this.minutes(), this.seconds(), this.milliseconds()]
        }, isValid: function () {
            return null == this._isValid && (this._isValid = this._a ? !C(this._a, (this._isUTC ? r.utc(this._a) : r(this._a)).toArray()) : !isNaN(this._d.getTime())), !!this._isValid
        }, utc: function () {
            return this.zone(0)
        }, local: function () {
            return this.zone(0), this._isUTC = !1, this
        }, format: function (b) {
            b = ca(this, b || r.defaultFormat);
            return this.lang().postformat(b)
        }, add: function (b, c) {
            var d;
            return d = "string" == typeof b ? r.duration(+c,
                b) : r.duration(b, c), G(this, d, 1), this
        }, subtract: function (b, c) {
            var d;
            return d = "string" == typeof b ? r.duration(+c, b) : r.duration(b, c), G(this, d, -1), this
        }, diff: function (b, c, d) {
            var e, f;
            b = this._isUTC ? r(b).zone(this._offset || 0) : r(b).local();
            var l = 6E4 * (this.zone() - b.zone());
            return c = H(c), "year" === c || "month" === c ? (e = 432E5 * (this.daysInMonth() + b.daysInMonth()), f = 12 * (this.year() - b.year()) + (this.month() - b.month()), f += (this - r(this).startOf("month") - (b - r(b).startOf("month"))) / e, f -= 6E4 * (this.zone() - r(this).startOf("month").zone() -
                (b.zone() - r(b).startOf("month").zone())) / e, "year" === c && (f /= 12)) : (e = this - b, f = "second" === c ? e / 1E3 : "minute" === c ? e / 6E4 : "hour" === c ? e / 36E5 : "day" === c ? (e - l) / 864E5 : "week" === c ? (e - l) / 6048E5 : e), d ? f : x(f)
        }, from: function (b, c) {
            return r.duration(this.diff(b)).lang(this.lang()._abbr).humanize(!c)
        }, fromNow: function (b) {
            return this.from(r(), b)
        }, calendar: function () {
            var b = this.diff(r().startOf("day"), "days", !0),
                b = -6 > b ? "sameElse" : -1 > b ? "lastWeek" : 0 > b ? "lastDay" : 1 > b ? "sameDay" : 2 > b ? "nextDay" : 7 > b ? "nextWeek" : "sameElse";
            return this.format(this.lang().calendar(b,
                this))
        }, isLeapYear: function () {
            var b = this.year();
            return 0 === b % 4 && 0 !== b % 100 || 0 === b % 400
        }, isDST: function () {
            return this.zone() < this.clone().month(0).zone() || this.zone() < this.clone().month(5).zone()
        }, day: function (b) {
            var c = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
            return null != b ? "string" == typeof b && (b = this.lang().weekdaysParse(b), "number" != typeof b) ? this : this.add({d: b - c}) : c
        }, month: function (b) {
            var c, d = this._isUTC ? "UTC" : "";
            return null != b ? "string" == typeof b && (b = this.lang().monthsParse(b), "number" != typeof b) ?
                this : (c = this.date(), this.date(1), this._d["set" + d + "Month"](b), this.date(Math.min(c, this.daysInMonth())), r.updateOffset(this), this) : this._d["get" + d + "Month"]()
        }, startOf: function (b) {
            switch (b = H(b)) {
                case "year":
                    this.month(0);
                case "month":
                    this.date(1);
                case "week":
                case "day":
                    this.hours(0);
                case "hour":
                    this.minutes(0);
                case "minute":
                    this.seconds(0);
                case "second":
                    this.milliseconds(0)
            }
            return "week" === b && this.weekday(0), this
        }, endOf: function (b) {
            return this.startOf(b).add(b, 1).subtract("ms", 1)
        }, isAfter: function (b,
                              c) {
            return c = "undefined" != typeof c ? c : "millisecond", +this.clone().startOf(c) > +r(b).startOf(c)
        }, isBefore: function (b, c) {
            return c = "undefined" != typeof c ? c : "millisecond", +this.clone().startOf(c) < +r(b).startOf(c)
        }, isSame: function (b, c) {
            return c = "undefined" != typeof c ? c : "millisecond", +this.clone().startOf(c) === +r(b).startOf(c)
        }, min: function (b) {
            return b = r.apply(null, arguments), this > b ? this : b
        }, max: function (b) {
            return b = r.apply(null, arguments), b > this ? this : b
        }, zone: function (b) {
            var c = this._offset || 0;
            return null == b ?
                this._isUTC ? c : this._d.getTimezoneOffset() : ("string" == typeof b && (b = F(b)), 16 > Math.abs(b) && (b *= 60), this._offset = b, this._isUTC = !0, c !== b && G(this, r.duration(c - b, "m"), 1, !0), this)
        }, zoneAbbr: function () {
            return this._isUTC ? "UTC" : ""
        }, zoneName: function () {
            return this._isUTC ? "Coordinated Universal Time" : ""
        }, daysInMonth: function () {
            return r.utc([this.year(), this.month() + 1, 0]).date()
        }, dayOfYear: function (b) {
            var c = ga((r(this).startOf("day") - r(this).startOf("year")) / 864E5) + 1;
            return null == b ? c : this.add("d", b - c)
        }, weekYear: function (b) {
            var c =
                V(this, this.lang()._week.dow, this.lang()._week.doy).year;
            return null == b ? c : this.add("y", b - c)
        }, isoWeekYear: function (b) {
            var c = V(this, 1, 4).year;
            return null == b ? c : this.add("y", b - c)
        }, week: function (b) {
            var c = this.lang().week(this);
            return null == b ? c : this.add("d", 7 * (b - c))
        }, isoWeek: function (b) {
            var c = V(this, 1, 4).week;
            return null == b ? c : this.add("d", 7 * (b - c))
        }, weekday: function (b) {
            var c = (this._d.getDay() + 7 - this.lang()._week.dow) % 7;
            return null == b ? c : this.add("d", b - c)
        }, isoWeekday: function (b) {
            return null == b ? this.day() ||
                7 : this.day(this.day() % 7 ? b : b - 7)
        }, lang: function (b) {
            return b === d ? this._lang : (this._lang = P(b), this)
        }
    };
    for (z = 0; z < K.length; z++)za(K[z].toLowerCase().replace(/s$/, ""), K[z]);
    za("year", "FullYear");
    r.fn.days = r.fn.day;
    r.fn.months = r.fn.month;
    r.fn.weeks = r.fn.week;
    r.fn.isoWeeks = r.fn.isoWeek;
    r.fn.toJSON = r.fn.toISOString;
    r.duration.fn = g.prototype = {
        _bubble: function () {
            var b, c;
            b = this._milliseconds;
            c = this._days;
            var d = this._months, e = this._data;
            e.milliseconds = b % 1E3;
            b = x(b / 1E3);
            e.seconds = b % 60;
            b = x(b / 60);
            e.minutes = b % 60;
            b =
                x(b / 60);
            e.hours = b % 24;
            c += x(b / 24);
            e.days = c % 30;
            d += x(c / 30);
            e.months = d % 12;
            c = x(d / 12);
            e.years = c
        }, weeks: function () {
            return x(this.days() / 7)
        }, valueOf: function () {
            return this._milliseconds + 864E5 * this._days + this._months % 12 * 2592E6 + 31536E6 * ~~(this._months / 12)
        }, humanize: function (b) {
            var c = +this, d;
            d = !b;
            var e = this.lang(), f = ga(Math.abs(c) / 1E3), l = ga(f / 60), g = ga(l / 60), q = ga(g / 24),
                k = ga(q / 365),
                f = 45 > f && ["s", f] || 1 === l && ["m"] || 45 > l && ["mm", l] || 1 === g && ["h"] || 22 > g && ["hh", g] || 1 === q && ["d"] || 25 >= q && ["dd", q] || 45 >= q && ["M"] || 345 > q && ["MM",
                        ga(q / 30)] || 1 === k && ["y"] || ["yy", k];
            d = (f[2] = d, f[3] = 0 < c, f[4] = e, I.apply({}, f));
            return b && (d = this.lang().pastFuture(c, d)), this.lang().postformat(d)
        }, add: function (b, c) {
            var d = r.duration(b, c);
            return this._milliseconds += d._milliseconds, this._days += d._days, this._months += d._months, this._bubble(), this
        }, subtract: function (b, c) {
            var d = r.duration(b, c);
            return this._milliseconds -= d._milliseconds, this._days -= d._days, this._months -= d._months, this._bubble(), this
        }, get: function (b) {
            return b = H(b), this[b.toLowerCase() + "s"]()
        },
        as: function (b) {
            return b = H(b), this["as" + b.charAt(0).toUpperCase() + b.slice(1) + "s"]()
        }, lang: r.fn.lang
    };
    for (z in f)f.hasOwnProperty(z) && (ka(z, f[z]), b(z.toLowerCase()));
    ka("Weeks", 6048E5);
    r.duration.fn.asMonths = function () {
        return (+this - 31536E6 * this.years()) / 2592E6 + 12 * this.years()
    };
    r.lang("en", {
        ordinal: function (b) {
            var c = b % 10;
            return b + (1 === ~~(b % 100 / 10) ? "th" : 1 === c ? "st" : 2 === c ? "nd" : 3 === c ? "rd" : "th")
        }
    });
    v && (module.exports = r);
    "undefined" == typeof ender && (this.moment = r);
    "function" == typeof define && define.amd && define("moment",
        [], function () {
            return r
        })
}.call(this);
if ("undefined" == typeof jQuery)throw Error("Bootstrap requires jQuery");
+function (d) {
    d.fn.emulateTransitionEnd = function (n) {
        var t = !1, c = this;
        d(this).one(d.support.transition.end, function () {
            t = !0
        });
        return setTimeout(function () {
            t || d(c).trigger(d.support.transition.end)
        }, n), this
    };
    d(function () {
        var n = d.support, t;
        a:{
            t = document.createElement("bootstrap");
            var c = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            }, e;
            for (e in c)if (void 0 !== t.style[e]) {
                t = {end: c[e]};
                break a
            }
            t = !1
        }
        n.transition = t
    })
}(jQuery);
+function (d) {
    var n = function (c) {
        d(c).on("click", '[data-dismiss="alert"]', this.close)
    };
    n.prototype.close = function (c) {
        function e() {
            n.trigger("closed.bs.alert").remove()
        }

        var g = d(this), k = g.attr("data-target");
        k || (k = g.attr("href"), k = k && k.replace(/.*(?=#[^\s]*$)/, ""));
        var n = d(k);
        c && c.preventDefault();
        n.length || (n = g.hasClass("alert") ? g : g.parent());
        n.trigger(c = d.Event("close.bs.alert"));
        c.isDefaultPrevented() || (n.removeClass("in"), d.support.transition && n.hasClass("fade") ? n.one(d.support.transition.end, e).emulateTransitionEnd(150) :
            e())
    };
    var t = d.fn.alert;
    d.fn.alert = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.alert");
            g || e.data("bs.alert", g = new n(this));
            "string" == typeof c && g[c].call(e)
        })
    };
    d.fn.alert.Constructor = n;
    d.fn.alert.noConflict = function () {
        return d.fn.alert = t, this
    };
    d(document).on("click.bs.alert.data-api", '[data-dismiss="alert"]', n.prototype.close)
}(jQuery);
+function (d) {
    var n = function (c, e) {
        this.$element = d(c);
        this.options = d.extend({}, n.DEFAULTS, e);
        this.isLoading = !1
    };
    n.DEFAULTS = {loadingText: "loading..."};
    n.prototype.setState = function (c) {
        var e = this.$element, g = e.is("input") ? "val" : "html", k = e.data();
        c += "Text";
        k.resetText || e.data("resetText", e[g]());
        e[g](k[c] || this.options[c]);
        setTimeout(d.proxy(function () {
                "loadingText" == c ? (this.isLoading = !0, e.addClass("disabled").attr("disabled", "disabled")) : this.isLoading && (this.isLoading = !1, e.removeClass("disabled").removeAttr("disabled"))
            },
            this), 0)
    };
    n.prototype.toggle = function () {
        var c = !0, d = this.$element.closest('[data-toggle="buttons"]');
        if (d.length) {
            var g = this.$element.find("input");
            "radio" == g.prop("type") && (g.prop("checked") && this.$element.hasClass("active") ? c = !1 : d.find(".active").removeClass("active"));
            c && g.prop("checked", !this.$element.hasClass("active")).trigger("change")
        }
        c && this.$element.toggleClass("active")
    };
    var t = d.fn.button;
    d.fn.button = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.button"), k = "object" ==
                typeof c && c;
            g || e.data("bs.button", g = new n(this, k));
            "toggle" == c ? g.toggle() : c && g.setState(c)
        })
    };
    d.fn.button.Constructor = n;
    d.fn.button.noConflict = function () {
        return d.fn.button = t, this
    };
    d(document).on("click.bs.button.data-api", "[data-toggle^=button]", function (c) {
        var e = d(c.target);
        e.hasClass("btn") || (e = e.closest(".btn"));
        e.button("toggle");
        c.preventDefault()
    })
}(jQuery);
+function (d) {
    var n = function (c, e) {
        this.$element = d(c);
        this.$indicators = this.$element.find(".carousel-indicators");
        this.options = e;
        this.paused = this.sliding = this.interval = this.$active = this.$items = null;
        "hover" == this.options.pause && this.$element.on("mouseenter", d.proxy(this.pause, this)).on("mouseleave", d.proxy(this.cycle, this))
    };
    n.DEFAULTS = {interval: 5E3, pause: "hover", wrap: !0};
    n.prototype.cycle = function (c) {
        return c || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused &&
        (this.interval = setInterval(d.proxy(this.next, this), this.options.interval)), this
    };
    n.prototype.getActiveIndex = function () {
        return this.$active = this.$element.find(".item.active"), this.$items = this.$active.parent().children(), this.$items.index(this.$active)
    };
    n.prototype.to = function (c) {
        var e = this, g = this.getActiveIndex();
        return c > this.$items.length - 1 || 0 > c ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
            e.to(c)
        }) : g == c ? this.pause().cycle() : this.slide(c > g ? "next" : "prev", d(this.$items[c]))
    };
    n.prototype.pause = function (c) {
        return c || (this.paused = !0), this.$element.find(".next, .prev").length && d.support.transition && (this.$element.trigger(d.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    };
    n.prototype.next = function () {
        return this.sliding ? void 0 : this.slide("next")
    };
    n.prototype.prev = function () {
        return this.sliding ? void 0 : this.slide("prev")
    };
    n.prototype.slide = function (c, e) {
        var g = this.$element.find(".item.active"), k = e || g[c](), n = this.interval, s = "next" == c ? "left" :
            "right", G = "next" == c ? "first" : "last", t = this;
        if (!k.length) {
            if (!this.options.wrap)return;
            k = this.$element.find(".item")[G]()
        }
        if (k.hasClass("active"))return this.sliding = !1;
        G = d.Event("slide.bs.carousel", {relatedTarget: k[0], direction: s});
        return this.$element.trigger(G), G.isDefaultPrevented() ? void 0 : (this.sliding = !0, n && this.pause(), this.$indicators.length && (this.$indicators.find(".active").removeClass("active"), this.$element.one("slid.bs.carousel", function () {
            var c = d(t.$indicators.children()[t.getActiveIndex()]);
            c && c.addClass("active")
        })), d.support.transition && this.$element.hasClass("slide") ? (k.addClass(c), k[0].offsetWidth, g.addClass(s), k.addClass(s), g.one(d.support.transition.end, function () {
            k.removeClass([c, s].join(" ")).addClass("active");
            g.removeClass(["active", s].join(" "));
            t.sliding = !1;
            setTimeout(function () {
                t.$element.trigger("slid.bs.carousel")
            }, 0)
        }).emulateTransitionEnd(1E3 * g.css("transition-duration").slice(0, -1))) : (g.removeClass("active"), k.addClass("active"), this.sliding = !1, this.$element.trigger("slid.bs.carousel")),
        n && this.cycle(), this)
    };
    var t = d.fn.carousel;
    d.fn.carousel = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.carousel"),
                k = d.extend({}, n.DEFAULTS, e.data(), "object" == typeof c && c),
                x = "string" == typeof c ? c : k.slide;
            g || e.data("bs.carousel", g = new n(this, k));
            "number" == typeof c ? g.to(c) : x ? g[x]() : k.interval && g.pause().cycle()
        })
    };
    d.fn.carousel.Constructor = n;
    d.fn.carousel.noConflict = function () {
        return d.fn.carousel = t, this
    };
    d(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]",
        function (c) {
            var e, g = d(this), k = d(g.attr("data-target") || (e = g.attr("href")) && e.replace(/.*(?=#[^\s]+$)/, ""));
            e = d.extend({}, k.data(), g.data());
            var n = g.attr("data-slide-to");
            n && (e.interval = !1);
            k.carousel(e);
            (n = g.attr("data-slide-to")) && k.data("bs.carousel").to(n);
            c.preventDefault()
        });
    d(window).on("load", function () {
        d('[data-ride="carousel"]').each(function () {
            var c = d(this);
            c.carousel(c.data())
        })
    })
}(jQuery);
+function (d) {
    var n = function (c, e) {
        this.$element = d(c);
        this.options = d.extend({}, n.DEFAULTS, e);
        this.transitioning = null;
        this.options.parent && (this.$parent = d(this.options.parent));
        this.options.toggle && this.toggle()
    };
    n.DEFAULTS = {toggle: !0};
    n.prototype.dimension = function () {
        return this.$element.hasClass("width") ? "width" : "height"
    };
    n.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var c = d.Event("show.bs.collapse");
            if (this.$element.trigger(c), !c.isDefaultPrevented()) {
                if ((c = this.$parent &&
                        this.$parent.find("> .panel > .in")) && c.length) {
                    var e = c.data("bs.collapse");
                    if (e && e.transitioning)return;
                    c.collapse("hide");
                    e || c.data("bs.collapse", null)
                }
                var g = this.dimension();
                this.$element.removeClass("collapse").addClass("collapsing")[g](0);
                this.transitioning = 1;
                c = function () {
                    this.$element.removeClass("collapsing").addClass("collapse in")[g]("auto");
                    this.transitioning = 0;
                    this.$element.trigger("shown.bs.collapse")
                };
                if (!d.support.transition)return c.call(this);
                e = d.camelCase(["scroll", g].join("-"));
                this.$element.one(d.support.transition.end, d.proxy(c, this)).emulateTransitionEnd(350)[g](this.$element[0][e])
            }
        }
    };
    n.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var c = d.Event("hide.bs.collapse");
            if (this.$element.trigger(c), !c.isDefaultPrevented()) {
                c = this.dimension();
                this.$element[c](this.$element[c]())[0].offsetHeight;
                this.$element.addClass("collapsing").removeClass("collapse").removeClass("in");
                this.transitioning = 1;
                var e = function () {
                    this.transitioning = 0;
                    this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")
                };
                return d.support.transition ? void this.$element[c](0).one(d.support.transition.end, d.proxy(e, this)).emulateTransitionEnd(350) : e.call(this)
            }
        }
    };
    n.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    };
    var t = d.fn.collapse;
    d.fn.collapse = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.collapse"),
                k = d.extend({}, n.DEFAULTS, e.data(), "object" == typeof c && c);
            !g && k.toggle && "show" == c && (c = !c);
            g || e.data("bs.collapse", g = new n(this, k));
            "string" == typeof c && g[c]()
        })
    };
    d.fn.collapse.Constructor =
        n;
    d.fn.collapse.noConflict = function () {
        return d.fn.collapse = t, this
    };
    d(document).on("click.bs.collapse.data-api", "[data-toggle=collapse]", function (c) {
        var e, g = d(this);
        c = g.attr("data-target") || c.preventDefault() || (e = g.attr("href")) && e.replace(/.*(?=#[^\s]+$)/, "");
        e = d(c);
        var k = (c = e.data("bs.collapse")) ? "toggle" : g.data(), n = g.attr("data-parent"), s = n && d(n);
        c && c.transitioning || (s && s.find('[data-toggle=collapse][data-parent="' + n + '"]').not(g).addClass("collapsed"), g[e.hasClass("in") ? "addClass" : "removeClass"]("collapsed"));
        e.collapse(k)
    })
}(jQuery);
+function (d) {
    function n(g) {
        d(c).remove();
        d(e).each(function () {
            var c = t(d(this)), e = {relatedTarget: this};
            c.hasClass("open") && (c.trigger(g = d.Event("hide.bs.dropdown", e)), g.isDefaultPrevented() || c.removeClass("open").trigger("hidden.bs.dropdown", e))
        })
    }

    function t(c) {
        var e = c.attr("data-target");
        e || (e = c.attr("href"), e = e && /#[A-Za-z]/.test(e) && e.replace(/.*(?=#[^\s]*$)/, ""));
        return (e = e && d(e)) && e.length ? e : c.parent()
    }

    var c = ".dropdown-backdrop", e = "[data-toggle=dropdown]", g = function (c) {
        d(c).on("click.bs.dropdown", this.toggle)
    };
    g.prototype.toggle = function (c) {
        var e = d(this);
        if (!e.is(".disabled, :disabled")) {
            var g = t(e), k = g.hasClass("open");
            if (n(), !k) {
                "ontouchstart" in document.documentElement && !g.closest(".navbar-nav").length && d('<div class="dropdown-backdrop"/>').insertAfter(d(this)).on("click", n);
                k = {relatedTarget: this};
                if (g.trigger(c = d.Event("show.bs.dropdown", k)), c.isDefaultPrevented())return;
                g.toggleClass("open").trigger("shown.bs.dropdown", k);
                e.focus()
            }
            return !1
        }
    };
    g.prototype.keydown = function (c) {
        if (/(38|40|27)/.test(c.keyCode)) {
            var g =
                d(this);
            if (c.preventDefault(), c.stopPropagation(), !g.is(".disabled, :disabled")) {
                var k = t(g), n = k.hasClass("open");
                if (!n || n && 27 == c.keyCode)return 27 == c.which && k.find(e).focus(), g.click();
                g = k.find("[role=menu] li:not(.divider):visible a, [role=listbox] li:not(.divider):visible a");
                g.length && (k = g.index(g.filter(":focus")), 38 == c.keyCode && 0 < k && k--, 40 == c.keyCode && k < g.length - 1 && k++, ~k || (k = 0), g.eq(k).focus())
            }
        }
    };
    var k = d.fn.dropdown;
    d.fn.dropdown = function (c) {
        return this.each(function () {
            var e = d(this), k = e.data("bs.dropdown");
            k || e.data("bs.dropdown", k = new g(this));
            "string" == typeof c && k[c].call(e)
        })
    };
    d.fn.dropdown.Constructor = g;
    d.fn.dropdown.noConflict = function () {
        return d.fn.dropdown = k, this
    };
    d(document).on("click.bs.dropdown.data-api", n).on("click.bs.dropdown.data-api", ".dropdown form", function (c) {
        c.stopPropagation()
    }).on("click.bs.dropdown.data-api", e, g.prototype.toggle).on("keydown.bs.dropdown.data-api", e + ", [role=menu], [role=listbox]", g.prototype.keydown)
}(jQuery);
+function (d) {
    var n = function (c, e) {
        this.options = e;
        this.$element = d(c);
        this.$backdrop = this.isShown = null;
        this.options.remote && this.$element.find(".modal-content").load(this.options.remote, d.proxy(function () {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    n.DEFAULTS = {backdrop: !0, keyboard: !0, show: !0};
    n.prototype.toggle = function (c) {
        return this[this.isShown ? "hide" : "show"](c)
    };
    n.prototype.show = function (c) {
        var e = this, g = d.Event("show.bs.modal", {relatedTarget: c});
        this.$element.trigger(g);
        this.isShown || g.isDefaultPrevented() ||
        (this.isShown = !0, this.escape(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', d.proxy(this.hide, this)), this.backdrop(function () {
            var g = d.support.transition && e.$element.hasClass("fade");
            e.$element.parent().length || e.$element.appendTo(document.body);
            e.$element.show().scrollTop(0);
            g && e.$element[0].offsetWidth;
            e.$element.addClass("in").attr("aria-hidden", !1);
            e.enforceFocus();
            var n = d.Event("shown.bs.modal", {relatedTarget: c});
            g ? e.$element.find(".modal-dialog").one(d.support.transition.end,
                function () {
                    e.$element.focus().trigger(n)
                }).emulateTransitionEnd(300) : e.$element.focus().trigger(n)
        }))
    };
    n.prototype.hide = function (c) {
        c && c.preventDefault();
        c = d.Event("hide.bs.modal");
        this.$element.trigger(c);
        this.isShown && !c.isDefaultPrevented() && (this.isShown = !1, this.escape(), d(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), d.support.transition && this.$element.hasClass("fade") ? this.$element.one(d.support.transition.end, d.proxy(this.hideModal,
            this)).emulateTransitionEnd(300) : this.hideModal())
    };
    n.prototype.enforceFocus = function () {
        d(document).off("focusin.bs.modal").on("focusin.bs.modal", d.proxy(function (c) {
            this.$element[0] === c.target || this.$element.has(c.target).length || this.$element.focus()
        }, this))
    };
    n.prototype.escape = function () {
        this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.bs.modal", d.proxy(function (c) {
            27 == c.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keyup.dismiss.bs.modal")
    };
    n.prototype.hideModal =
        function () {
            var c = this;
            this.$element.hide();
            this.backdrop(function () {
                c.removeBackdrop();
                c.$element.trigger("hidden.bs.modal")
            })
        };
    n.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove();
        this.$backdrop = null
    };
    n.prototype.backdrop = function (c) {
        var e = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var g = d.support.transition && e;
            if (this.$backdrop = d('<div class="modal-backdrop ' + e + '" />').appendTo(document.body), this.$element.on("click.dismiss.bs.modal",
                    d.proxy(function (c) {
                        c.target === c.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
                    }, this)), g && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), c) g ? this.$backdrop.one(d.support.transition.end, c).emulateTransitionEnd(150) : c()
        } else!this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), d.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(d.support.transition.end, c).emulateTransitionEnd(150) : c()) : c &&
            c()
    };
    var t = d.fn.modal;
    d.fn.modal = function (c, e) {
        return this.each(function () {
            var g = d(this), k = g.data("bs.modal"), x = d.extend({}, n.DEFAULTS, g.data(), "object" == typeof c && c);
            k || g.data("bs.modal", k = new n(this, x));
            "string" == typeof c ? k[c](e) : x.show && k.show(e)
        })
    };
    d.fn.modal.Constructor = n;
    d.fn.modal.noConflict = function () {
        return d.fn.modal = t, this
    };
    d(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
        var e = d(this), g = e.attr("href"), k = d(e.attr("data-target") || g && g.replace(/.*(?=#[^\s]+$)/,
                "")), g = k.data("bs.modal") ? "toggle" : d.extend({remote: !/#/.test(g) && g}, k.data(), e.data());
        e.is("a") && c.preventDefault();
        k.modal(g, this).one("hide", function () {
            e.is(":visible") && e.focus()
        })
    });
    d(document).on("show.bs.modal", ".modal", function () {
        d(document.body).addClass("modal-open")
    }).on("hidden.bs.modal", ".modal", function () {
        d(document.body).removeClass("modal-open")
    })
}(jQuery);
+function (d) {
    var n = function (c, d) {
        this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null;
        this.init("tooltip", c, d)
    };
    n.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1
    };
    n.prototype.init = function (c, e, g) {
        this.enabled = !0;
        this.type = c;
        this.$element = d(e);
        this.options = this.getOptions(g);
        c = this.options.trigger.split(" ");
        for (e = c.length; e--;)if (g = c[e], "click" == g) this.$element.on("click." + this.type, this.options.selector, d.proxy(this.toggle, this)); else if ("manual" != g) {
            var k = "hover" == g ? "mouseleave" : "focusout";
            this.$element.on(("hover" == g ? "mouseenter" : "focusin") + "." + this.type, this.options.selector, d.proxy(this.enter, this));
            this.$element.on(k + "." + this.type, this.options.selector, d.proxy(this.leave, this))
        }
        this.options.selector ? this._options = d.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    };
    n.prototype.getDefaults =
        function () {
            return n.DEFAULTS
        };
    n.prototype.getOptions = function (c) {
        return c = d.extend({}, this.getDefaults(), this.$element.data(), c), c.delay && "number" == typeof c.delay && (c.delay = {
            show: c.delay,
            hide: c.delay
        }), c
    };
    n.prototype.getDelegateOptions = function () {
        var c = {}, e = this.getDefaults();
        return this._options && d.each(this._options, function (d, k) {
            e[d] != k && (c[d] = k)
        }), c
    };
    n.prototype.enter = function (c) {
        var e = c instanceof this.constructor ? c : d(c.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
        return clearTimeout(e.timeout), e.hoverState = "in", e.options.delay && e.options.delay.show ? void(e.timeout = setTimeout(function () {
            "in" == e.hoverState && e.show()
        }, e.options.delay.show)) : e.show()
    };
    n.prototype.leave = function (c) {
        var e = c instanceof this.constructor ? c : d(c.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
        return clearTimeout(e.timeout), e.hoverState = "out", e.options.delay && e.options.delay.hide ? void(e.timeout = setTimeout(function () {
            "out" == e.hoverState && e.hide()
        }, e.options.delay.hide)) :
            e.hide()
    };
    n.prototype.show = function () {
        var c = d.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled && (this.$element.trigger(c), !c.isDefaultPrevented())) {
            var e = this, c = this.tip();
            this.setContent();
            this.options.animation && c.addClass("fade");
            var g = "function" == typeof this.options.placement ? this.options.placement.call(this, c[0], this.$element[0]) : this.options.placement,
                k = /\s?auto?\s?/i, n = k.test(g);
            n && (g = g.replace(k, "") || "top");
            c.detach().css({top: 0, left: 0, display: "block"}).addClass(g);
            this.options.container ?
                c.appendTo(this.options.container) : c.insertAfter(this.$element);
            var k = this.getPosition(), s = c[0].offsetWidth, t = c[0].offsetHeight;
            if (n) {
                var C = this.$element.parent(), n = g,
                    H = document.documentElement.scrollTop || document.body.scrollTop,
                    P = "body" == this.options.container ? window.innerWidth : C.outerWidth(),
                    T = "body" == this.options.container ? window.innerHeight : C.outerHeight(),
                    C = "body" == this.options.container ? 0 : C.offset().left,
                    g = "bottom" == g && k.top + k.height + t - H > T ? "top" : "top" == g && 0 > k.top - H - t ? "bottom" : "right" == g && k.right +
                    s > P ? "left" : "left" == g && k.left - s < C ? "right" : g;
                c.removeClass(n).addClass(g)
            }
            k = this.getCalculatedOffset(g, k, s, t);
            this.applyPlacement(k, g);
            this.hoverState = null;
            g = function () {
                e.$element.trigger("shown.bs." + e.type)
            };
            d.support.transition && this.$tip.hasClass("fade") ? c.one(d.support.transition.end, g).emulateTransitionEnd(150) : g()
        }
    };
    n.prototype.applyPlacement = function (c, e) {
        var g, k = this.tip(), n = k[0].offsetWidth, s = k[0].offsetHeight, t = parseInt(k.css("margin-top"), 10),
            C = parseInt(k.css("margin-left"), 10);
        isNaN(t) &&
        (t = 0);
        isNaN(C) && (C = 0);
        c.top += t;
        c.left += C;
        d.offset.setOffset(k[0], d.extend({
            using: function (c) {
                k.css({top: Math.round(c.top), left: Math.round(c.left)})
            }
        }, c), 0);
        k.addClass("in");
        t = k[0].offsetWidth;
        C = k[0].offsetHeight;
        ("top" == e && C != s && (g = !0, c.top = c.top + s - C), /bottom|top/.test(e)) ? (s = 0, 0 > c.left && (s = -2 * c.left, c.left = 0, k.offset(c), t = k[0].offsetWidth, C = k[0].offsetHeight), this.replaceArrow(s - n + t, t, "left")) : this.replaceArrow(C - s, C, "top");
        g && k.offset(c)
    };
    n.prototype.replaceArrow = function (c, d, g) {
        this.arrow().css(g,
            c ? 50 * (1 - c / d) + "%" : "")
    };
    n.prototype.setContent = function () {
        var c = this.tip(), d = this.getTitle();
        c.find(".tooltip-inner")[this.options.html ? "html" : "text"](d);
        c.removeClass("fade in top bottom left right")
    };
    n.prototype.hide = function () {
        function c() {
            "in" != e.hoverState && g.detach();
            e.$element.trigger("hidden.bs." + e.type)
        }

        var e = this, g = this.tip(), k = d.Event("hide.bs." + this.type);
        return this.$element.trigger(k), k.isDefaultPrevented() ? void 0 : (g.removeClass("in"), d.support.transition && this.$tip.hasClass("fade") ? g.one(d.support.transition.end,
            c).emulateTransitionEnd(150) : c(), this.hoverState = null, this)
    };
    n.prototype.fixTitle = function () {
        var c = this.$element;
        (c.attr("title") || "string" != typeof c.attr("data-original-title")) && c.attr("data-original-title", c.attr("title") || "").attr("title", "")
    };
    n.prototype.hasContent = function () {
        return this.getTitle()
    };
    n.prototype.getPosition = function () {
        var c = this.$element[0];
        return d.extend({}, "function" == typeof c.getBoundingClientRect ? c.getBoundingClientRect() : {
            width: c.offsetWidth,
            height: c.offsetHeight
        }, this.$element.offset())
    };
    n.prototype.getCalculatedOffset = function (c, d, g, k) {
        return "bottom" == c ? {
            top: d.top + d.height,
            left: d.left + d.width / 2 - g / 2
        } : "top" == c ? {
            top: d.top - k,
            left: d.left + d.width / 2 - g / 2
        } : "left" == c ? {top: d.top + d.height / 2 - k / 2, left: d.left - g} : {
            top: d.top + d.height / 2 - k / 2,
            left: d.left + d.width
        }
    };
    n.prototype.getTitle = function () {
        var c = this.$element, d = this.options;
        return c.attr("data-original-title") || ("function" == typeof d.title ? d.title.call(c[0]) : d.title)
    };
    n.prototype.tip = function () {
        return this.$tip = this.$tip || d(this.options.template)
    };
    n.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    };
    n.prototype.validate = function () {
        this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null)
    };
    n.prototype.enable = function () {
        this.enabled = !0
    };
    n.prototype.disable = function () {
        this.enabled = !1
    };
    n.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled
    };
    n.prototype.toggle = function (c) {
        c = c ? d(c.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type) : this;
        c.tip().hasClass("in") ?
            c.leave(c) : c.enter(c)
    };
    n.prototype.destroy = function () {
        clearTimeout(this.timeout);
        this.hide().$element.off("." + this.type).removeData("bs." + this.type)
    };
    var t = d.fn.tooltip;
    d.fn.tooltip = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.tooltip"), k = "object" == typeof c && c;
            (g || "destroy" != c) && (g || e.data("bs.tooltip", g = new n(this, k)), "string" == typeof c && g[c]())
        })
    };
    d.fn.tooltip.Constructor = n;
    d.fn.tooltip.noConflict = function () {
        return d.fn.tooltip = t, this
    }
}(jQuery);
+function (d) {
    var n = function (c, d) {
        this.init("popover", c, d)
    };
    if (!d.fn.tooltip)throw Error("Popover requires tooltip.js");
    n.DEFAULTS = d.extend({}, d.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    });
    n.prototype = d.extend({}, d.fn.tooltip.Constructor.prototype);
    n.prototype.constructor = n;
    n.prototype.getDefaults = function () {
        return n.DEFAULTS
    };
    n.prototype.setContent =
        function () {
            var c = this.tip(), d = this.getTitle(), g = this.getContent();
            c.find(".popover-title")[this.options.html ? "html" : "text"](d);
            c.find(".popover-content")[this.options.html ? "string" == typeof g ? "html" : "append" : "text"](g);
            c.removeClass("fade top bottom left right in");
            c.find(".popover-title").html() || c.find(".popover-title").hide()
        };
    n.prototype.hasContent = function () {
        return this.getTitle() || this.getContent()
    };
    n.prototype.getContent = function () {
        var c = this.$element, d = this.options;
        return c.attr("data-content") ||
            ("function" == typeof d.content ? d.content.call(c[0]) : d.content)
    };
    n.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    };
    n.prototype.tip = function () {
        return this.$tip || (this.$tip = d(this.options.template)), this.$tip
    };
    var t = d.fn.popover;
    d.fn.popover = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.popover"), k = "object" == typeof c && c;
            (g || "destroy" != c) && (g || e.data("bs.popover", g = new n(this, k)), "string" == typeof c && g[c]())
        })
    };
    d.fn.popover.Constructor = n;
    d.fn.popover.noConflict =
        function () {
            return d.fn.popover = t, this
        }
}(jQuery);
+function (d) {
    function n(c, e) {
        var g, k = d.proxy(this.process, this);
        this.$element = d(d(c).is("body") ? window : c);
        this.$body = d("body");
        this.$scrollElement = this.$element.on("scroll.bs.scroll-spy.data-api", k);
        this.options = d.extend({}, n.DEFAULTS, e);
        this.selector = (this.options.target || (g = d(c).attr("href")) && g.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a";
        this.offsets = d([]);
        this.targets = d([]);
        this.activeTarget = null;
        this.refresh();
        this.process()
    }

    n.DEFAULTS = {offset: 10};
    n.prototype.refresh = function () {
        var c = this.$element[0] ==
        window ? "offset" : "position";
        this.offsets = d([]);
        this.targets = d([]);
        var e = this;
        this.$body.find(this.selector).map(function () {
            var g = d(this), g = g.data("target") || g.attr("href"), k = /^#./.test(g) && d(g);
            return k && k.length && k.is(":visible") && [[k[c]().top + (!d.isWindow(e.$scrollElement.get(0)) && e.$scrollElement.scrollTop()), g]] || null
        }).sort(function (c, d) {
            return c[0] - d[0]
        }).each(function () {
            e.offsets.push(this[0]);
            e.targets.push(this[1])
        })
    };
    n.prototype.process = function () {
        var c, d = this.$scrollElement.scrollTop() +
                this.options.offset,
            g = (this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight) - this.$scrollElement.height(),
            k = this.offsets, n = this.targets, s = this.activeTarget;
        if (d >= g)return s != (c = n.last()[0]) && this.activate(c);
        if (s && d <= k[0])return s != (c = n[0]) && this.activate(c);
        for (c = k.length; c--;)s != n[c] && d >= k[c] && (!k[c + 1] || d <= k[c + 1]) && this.activate(n[c])
    };
    n.prototype.activate = function (c) {
        this.activeTarget = c;
        d(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
        c = d(this.selector +
            '[data-target="' + c + '"],' + this.selector + '[href="' + c + '"]').parents("li").addClass("active");
        c.parent(".dropdown-menu").length && (c = c.closest("li.dropdown").addClass("active"));
        c.trigger("activate.bs.scrollspy")
    };
    var t = d.fn.scrollspy;
    d.fn.scrollspy = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.scrollspy"), k = "object" == typeof c && c;
            g || e.data("bs.scrollspy", g = new n(this, k));
            "string" == typeof c && g[c]()
        })
    };
    d.fn.scrollspy.Constructor = n;
    d.fn.scrollspy.noConflict = function () {
        return d.fn.scrollspy =
            t, this
    };
    d(window).on("load", function () {
        d('[data-spy="scroll"]').each(function () {
            var c = d(this);
            c.scrollspy(c.data())
        })
    })
}(jQuery);
+function (d) {
    var n = function (c) {
        this.element = d(c)
    };
    n.prototype.show = function () {
        var c = this.element, e = c.closest("ul:not(.dropdown-menu)"), g = c.data("target");
        if (g || (g = c.attr("href"), g = g && g.replace(/.*(?=#[^\s]*$)/, "")), !c.parent("li").hasClass("active")) {
            var k = e.find(".active:last a")[0], n = d.Event("show.bs.tab", {relatedTarget: k});
            (c.trigger(n), n.isDefaultPrevented()) || (g = d(g), this.activate(c.parent("li"), e), this.activate(g, g.parent(), function () {
                c.trigger({type: "shown.bs.tab", relatedTarget: k})
            }))
        }
    };
    n.prototype.activate =
        function (c, e, g) {
            function k() {
                n.removeClass("active").find("> .dropdown-menu > .active").removeClass("active");
                c.addClass("active");
                s ? (c[0].offsetWidth, c.addClass("in")) : c.removeClass("fade");
                c.parent(".dropdown-menu") && c.closest("li.dropdown").addClass("active");
                g && g()
            }

            var n = e.find("> .active"), s = g && d.support.transition && n.hasClass("fade");
            s ? n.one(d.support.transition.end, k).emulateTransitionEnd(150) : k();
            n.removeClass("in")
        };
    var t = d.fn.tab;
    d.fn.tab = function (c) {
        return this.each(function () {
            var e = d(this),
                g = e.data("bs.tab");
            g || e.data("bs.tab", g = new n(this));
            "string" == typeof c && g[c]()
        })
    };
    d.fn.tab.Constructor = n;
    d.fn.tab.noConflict = function () {
        return d.fn.tab = t, this
    };
    d(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function (c) {
        c.preventDefault();
        d(this).tab("show")
    })
}(jQuery);
+function (d) {
    var n = function (c, e) {
        this.options = d.extend({}, n.DEFAULTS, e);
        this.$window = d(window).on("scroll.bs.affix.data-api", d.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", d.proxy(this.checkPositionWithEventLoop, this));
        this.$element = d(c);
        this.affixed = this.unpin = this.pinnedOffset = null;
        this.checkPosition()
    };
    n.RESET = "affix affix-top affix-bottom";
    n.DEFAULTS = {offset: 0};
    n.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset)return this.pinnedOffset;
        this.$element.removeClass(n.RESET).addClass("affix");
        var c = this.$window.scrollTop();
        return this.pinnedOffset = this.$element.offset().top - c
    };
    n.prototype.checkPositionWithEventLoop = function () {
        setTimeout(d.proxy(this.checkPosition, this), 1)
    };
    n.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
            var c = d(document).height(), e = this.$window.scrollTop(), g = this.$element.offset(),
                k = this.options.offset, x = k.top, s = k.bottom;
            "top" == this.affixed && (g.top += e);
            "object" != typeof k && (s = x = k);
            "function" == typeof x && (x = k.top(this.$element));
            "function" == typeof s &&
            (s = k.bottom(this.$element));
            e = null != this.unpin && e + this.unpin <= g.top ? !1 : null != s && g.top + this.$element.height() >= c - s ? "bottom" : null != x && x >= e ? "top" : !1;
            this.affixed !== e && (this.unpin && this.$element.css("top", ""), g = "affix" + (e ? "-" + e : ""), k = d.Event(g + ".bs.affix"), this.$element.trigger(k), k.isDefaultPrevented() || (this.affixed = e, this.unpin = "bottom" == e ? this.getPinnedOffset() : null, this.$element.removeClass(n.RESET).addClass(g).trigger(d.Event(g.replace("affix", "affixed"))), "bottom" == e && this.$element.offset({
                top: c -
                s - this.$element.height()
            })))
        }
    };
    var t = d.fn.affix;
    d.fn.affix = function (c) {
        return this.each(function () {
            var e = d(this), g = e.data("bs.affix"), k = "object" == typeof c && c;
            g || e.data("bs.affix", g = new n(this, k));
            "string" == typeof c && g[c]()
        })
    };
    d.fn.affix.Constructor = n;
    d.fn.affix.noConflict = function () {
        return d.fn.affix = t, this
    };
    d(window).on("load", function () {
        d('[data-spy="affix"]').each(function () {
            var c = d(this), e = c.data();
            e.offset = e.offset || {};
            e.offsetBottom && (e.offset.bottom = e.offsetBottom);
            e.offsetTop && (e.offset.top =
                e.offsetTop);
            c.affix(e)
        })
    })
}(jQuery);
!function (d) {
    "function" == typeof define && define.amd ? define(["jquery"], d) : d(jQuery)
}(function (d) {
    d.extend(d.fn, {
        validate: function (c) {
            if (!this.length)return void(c && c.debug && window.console && console.warn("Nothing selected, can't validate, returning nothing."));
            var e = d.data(this[0], "validator");
            return e ? e : (this.attr("novalidate", "novalidate"), e = new d.validator(c, this[0]), d.data(this[0], "validator", e), e.settings.onsubmit && (this.validateDelegate(":submit", "click", function (c) {
                e.settings.submitHandler && (e.submitButton =
                    c.target);
                d(c.target).hasClass("cancel") && (e.cancelSubmit = !0);
                void 0 !== d(c.target).attr("formnovalidate") && (e.cancelSubmit = !0)
            }), this.submit(function (c) {
                function k() {
                    var k;
                    return e.settings.submitHandler ? (e.submitButton && (k = d("<input type='hidden'/>").attr("name", e.submitButton.name).val(d(e.submitButton).val()).appendTo(e.currentForm)), e.settings.submitHandler.call(e, e.currentForm, c), e.submitButton && k.remove(), !1) : !0
                }

                return e.settings.debug && c.preventDefault(), e.cancelSubmit ? (e.cancelSubmit = !1, k()) :
                    e.form() ? e.pendingRequest ? (e.formSubmitted = !0, !1) : k() : (e.focusInvalid(), !1)
            })), e)
        }, valid: function () {
            var c, e;
            return d(this[0]).is("form") ? c = this.validate().form() : (c = !0, e = d(this[0].form).validate(), this.each(function () {
                c = e.element(this) && c
            })), c
        }, removeAttrs: function (c) {
            var e = {}, g = this;
            return d.each(c.split(/\s/), function (c, d) {
                e[d] = g.attr(d);
                g.removeAttr(d)
            }), e
        }, rules: function (c, e) {
            var g, k, n, s, t, C, H = this[0];
            if (c)switch (g = d.data(H.form, "validator").settings, k = g.rules, n = d.validator.staticRules(H), c) {
                case "add":
                    d.extend(n,
                        d.validator.normalizeRule(e));
                    delete n.messages;
                    k[H.name] = n;
                    e.messages && (g.messages[H.name] = d.extend(g.messages[H.name], e.messages));
                    break;
                case "remove":
                    return e ? (C = {}, d.each(e.split(/\s/), function (c, e) {
                        C[e] = n[e];
                        delete n[e];
                        "required" === e && d(H).removeAttr("aria-required")
                    }), C) : (delete k[H.name], n)
            }
            return s = d.validator.normalizeRules(d.extend({}, d.validator.classRules(H), d.validator.attributeRules(H), d.validator.dataRules(H), d.validator.staticRules(H)), H), s.required && (t = s.required, delete s.required,
                s = d.extend({required: t}, s), d(H).attr("aria-required", "true")), s.remote && (t = s.remote, delete s.remote, s = d.extend(s, {remote: t})), s
        }
    });
    d.extend(d.expr[":"], {
        blank: function (c) {
            return !d.trim("" + d(c).val())
        }, filled: function (c) {
            return !!d.trim("" + d(c).val())
        }, unchecked: function (c) {
            return !d(c).prop("checked")
        }
    });
    d.validator = function (c, e) {
        this.settings = d.extend(!0, {}, d.validator.defaults, c);
        this.currentForm = e;
        this.init()
    };
    d.validator.format = function (c, e) {
        return 1 === arguments.length ? function () {
            var e = d.makeArray(arguments);
            return e.unshift(c), d.validator.format.apply(this, e)
        } : (2 < arguments.length && e.constructor !== Array && (e = d.makeArray(arguments).slice(1)), e.constructor !== Array && (e = [e]), d.each(e, function (d, e) {
            c = c.replace(new RegExp("\\{" + d + "\\}", "g"), function () {
                return e
            })
        }), c)
    };
    d.extend(d.validator, {
        defaults: {
            messages: {},
            groups: {},
            rules: {},
            errorClass: "error",
            validClass: "valid",
            errorElement: "label",
            focusInvalid: !0,
            errorContainer: d([]),
            errorLabelContainer: d([]),
            onsubmit: !0,
            ignore: ":hidden",
            ignoreTitle: !1,
            onfocusin: function (c) {
                this.lastActive =
                    c;
                this.settings.focusCleanup && !this.blockFocusCleanup && (this.settings.unhighlight && this.settings.unhighlight.call(this, c, this.settings.errorClass, this.settings.validClass), this.hideThese(this.errorsFor(c)))
            },
            onfocusout: function (c) {
                this.checkable(c) || !(c.name in this.submitted) && this.optional(c) || this.element(c)
            },
            onkeyup: function (c, d) {
                (9 !== d.which || "" !== this.elementValue(c)) && (c.name in this.submitted || c === this.lastElement) && this.element(c)
            },
            onclick: function (c) {
                c.name in this.submitted ? this.element(c) :
                    c.parentNode.name in this.submitted && this.element(c.parentNode)
            },
            highlight: function (c, e, g) {
                "radio" === c.type ? this.findByName(c.name).addClass(e).removeClass(g) : d(c).addClass(e).removeClass(g)
            },
            unhighlight: function (c, e, g) {
                "radio" === c.type ? this.findByName(c.name).removeClass(e).addClass(g) : d(c).removeClass(e).addClass(g)
            }
        }, setDefaults: function (c) {
            d.extend(d.validator.defaults, c)
        }, messages: {
            required: "This field is required.",
            remote: "Please fix this field.",
            email: "Please enter a valid email address.",
            url: "Please enter a valid URL.",
            date: "Please enter a valid date.",
            dateISO: "Please enter a valid date ( ISO ).",
            number: "Please enter a valid number.",
            digits: "Please enter only digits.",
            creditcard: "Please enter a valid credit card number.",
            equalTo: "Please enter the same value again.",
            maxlength: d.validator.format("Please enter no more than {0} characters."),
            minlength: d.validator.format("Please enter at least {0} characters."),
            rangelength: d.validator.format("Please enter a value between {0} and {1} characters long."),
            range: d.validator.format("Please enter a value between {0} and {1}."),
            max: d.validator.format("Please enter a value less than or equal to {0}."),
            min: d.validator.format("Please enter a value greater than or equal to {0}.")
        }, autoCreateRanges: !1, prototype: {
            init: function () {
                function c(c) {
                    var e = d.data(this[0].form, "validator"), g = "on" + c.type.replace(/^validate/, ""),
                        n = e.settings;
                    n[g] && !this.is(n.ignore) && n[g].call(e, this[0], c)
                }

                this.labelContainer = d(this.settings.errorLabelContainer);
                this.errorContext = this.labelContainer.length &&
                    this.labelContainer || d(this.currentForm);
                this.containers = d(this.settings.errorContainer).add(this.settings.errorLabelContainer);
                this.submitted = {};
                this.valueCache = {};
                this.pendingRequest = 0;
                this.pending = {};
                this.invalid = {};
                this.reset();
                var e, g = this.groups = {};
                d.each(this.settings.groups, function (c, e) {
                    "string" == typeof e && (e = e.split(/\s/));
                    d.each(e, function (d, e) {
                        g[e] = c
                    })
                });
                e = this.settings.rules;
                d.each(e, function (c, g) {
                    e[c] = d.validator.normalizeRule(g)
                });
                d(this.currentForm).validateDelegate(":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox']",
                    "focusin focusout keyup", c).validateDelegate("select, option, [type='radio'], [type='checkbox']", "click", c);
                this.settings.invalidHandler && d(this.currentForm).bind("invalid-form.validate", this.settings.invalidHandler);
                d(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required", "true")
            }, form: function () {
                return this.checkForm(), d.extend(this.submitted, this.errorMap), this.invalid = d.extend({}, this.errorMap), this.valid() || d(this.currentForm).triggerHandler("invalid-form",
                    [this]), this.showErrors(), this.valid()
            }, checkForm: function () {
                this.prepareForm();
                for (var c = 0, d = this.currentElements = this.elements(); d[c]; c++)this.check(d[c]);
                return this.valid()
            }, element: function (c) {
                var e = this.clean(c), g = this.validationTargetFor(e), k = !0;
                return this.lastElement = g, void 0 === g ? delete this.invalid[e.name] : (this.prepareElement(g), this.currentElements = d(g), k = !1 !== this.check(g), k ? delete this.invalid[g.name] : this.invalid[g.name] = !0), d(c).attr("aria-invalid", !k), this.numberOfInvalids() || (this.toHide =
                    this.toHide.add(this.containers)), this.showErrors(), k
            }, showErrors: function (c) {
                if (c) {
                    d.extend(this.errorMap, c);
                    this.errorList = [];
                    for (var e in c)this.errorList.push({message: c[e], element: this.findByName(e)[0]});
                    this.successList = d.grep(this.successList, function (d) {
                        return !(d.name in c)
                    })
                }
                this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
            }, resetForm: function () {
                d.fn.resetForm && d(this.currentForm).resetForm();
                this.submitted = {};
                this.lastElement =
                    null;
                this.prepareForm();
                this.hideErrors();
                this.elements().removeClass(this.settings.errorClass).removeData("previousValue").removeAttr("aria-invalid")
            }, numberOfInvalids: function () {
                return this.objectLength(this.invalid)
            }, objectLength: function (c) {
                var d, g = 0;
                for (d in c)g++;
                return g
            }, hideErrors: function () {
                this.hideThese(this.toHide)
            }, hideThese: function (c) {
                c.not(this.containers).text("");
                this.addWrapper(c).hide()
            }, valid: function () {
                return 0 === this.size()
            }, size: function () {
                return this.errorList.length
            }, focusInvalid: function () {
                if (this.settings.focusInvalid)try {
                    d(this.findLastActive() ||
                        this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
                } catch (c) {
                }
            }, findLastActive: function () {
                var c = this.lastActive;
                return c && 1 === d.grep(this.errorList, function (d) {
                        return d.element.name === c.name
                    }).length && c
            }, elements: function () {
                var c = this, e = {};
                return d(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function () {
                    return !this.name && c.settings.debug && window.console && console.error("%o has no name assigned",
                        this), this.name in e || !c.objectLength(d(this).rules()) ? !1 : (e[this.name] = !0, !0)
                })
            }, clean: function (c) {
                return d(c)[0]
            }, errors: function () {
                var c = this.settings.errorClass.split(" ").join(".");
                return d(this.settings.errorElement + "." + c, this.errorContext)
            }, reset: function () {
                this.successList = [];
                this.errorList = [];
                this.errorMap = {};
                this.toShow = d([]);
                this.toHide = d([]);
                this.currentElements = d([])
            }, prepareForm: function () {
                this.reset();
                this.toHide = this.errors().add(this.containers)
            }, prepareElement: function (c) {
                this.reset();
                this.toHide = this.errorsFor(c)
            }, elementValue: function (c) {
                var e, g = d(c), k = c.type;
                return "radio" === k || "checkbox" === k ? d("input[name='" + c.name + "']:checked").val() : "number" === k && "undefined" != typeof c.validity ? c.validity.badInput ? !1 : g.val() : (e = g.val(), "string" == typeof e ? e.replace(/\r/g, "") : e)
            }, check: function (c) {
                c = this.validationTargetFor(this.clean(c));
                var e, g, k, n = d(c).rules(), s = d.map(n, function (c, d) {
                    return d
                }).length, t = !1, C = this.elementValue(c);
                for (g in n) {
                    k = {method: g, parameters: n[g]};
                    try {
                        if (e = d.validator.methods[g].call(this,
                                C, c, k.parameters), "dependency-mismatch" === e && 1 === s) t = !0; else {
                            if (t = !1, "pending" === e)return void(this.toHide = this.toHide.not(this.errorsFor(c)));
                            if (!e)return this.formatAndAdd(c, k), !1
                        }
                    } catch (H) {
                        throw this.settings.debug && window.console && console.log("Exception occurred when checking element " + c.id + ", check the '" + k.method + "' method.", H), H;
                    }
                }
                if (!t)return this.objectLength(n) && this.successList.push(c), !0
            }, customDataMessage: function (c, e) {
                return d(c).data("msg" + e.charAt(0).toUpperCase() + e.substring(1).toLowerCase()) ||
                    d(c).data("msg")
            }, customMessage: function (c, d) {
                var g = this.settings.messages[c];
                return g && (g.constructor === String ? g : g[d])
            }, findDefined: function () {
                for (var c = 0; c < arguments.length; c++)if (void 0 !== arguments[c])return arguments[c]
            }, defaultMessage: function (c, e) {
                return this.findDefined(this.customMessage(c.name, e), this.customDataMessage(c, e), !this.settings.ignoreTitle && c.title || void 0, d.validator.messages[e], "<strong>Warning: No message defined for " + c.name + "</strong>")
            }, formatAndAdd: function (c, e) {
                var g = this.defaultMessage(c,
                    e.method), k = /\$?\{(\d+)\}/g;
                "function" == typeof g ? g = g.call(this, e.parameters, c) : k.test(g) && (g = d.validator.format(g.replace(k, "{$1}"), e.parameters));
                this.errorList.push({message: g, element: c, method: e.method});
                this.errorMap[c.name] = g;
                this.submitted[c.name] = g
            }, addWrapper: function (c) {
                return this.settings.wrapper && (c = c.add(c.parent(this.settings.wrapper))), c
            }, defaultShowErrors: function () {
                var c, d;
                for (c = 0; this.errorList[c]; c++)d = this.errorList[c], this.settings.highlight && this.settings.highlight.call(this,
                    d.element, this.settings.errorClass, this.settings.validClass), this.showLabel(d.element, d.message);
                if (this.errorList.length && (this.toShow = this.toShow.add(this.containers)), this.settings.success)for (c = 0; this.successList[c]; c++)this.showLabel(this.successList[c]);
                if (this.settings.unhighlight)for (c = 0, d = this.validElements(); d[c]; c++)this.settings.unhighlight.call(this, d[c], this.settings.errorClass, this.settings.validClass);
                this.toHide = this.toHide.not(this.toShow);
                this.hideErrors();
                this.addWrapper(this.toShow).show()
            },
            validElements: function () {
                return this.currentElements.not(this.invalidElements())
            }, invalidElements: function () {
                return d(this.errorList).map(function () {
                    return this.element
                })
            }, showLabel: function (c, e) {
                var g, k, n, s = this.errorsFor(c), t = this.idOrName(c), C = d(c).attr("aria-describedby");
                s.length ? (s.removeClass(this.settings.validClass).addClass(this.settings.errorClass), s.html(e)) : (s = d("<" + this.settings.errorElement + ">").attr("id", t + "-error").addClass(this.settings.errorClass).html(e || ""), g = s, this.settings.wrapper &&
                (g = s.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()), this.labelContainer.length ? this.labelContainer.append(g) : this.settings.errorPlacement ? this.settings.errorPlacement(g, d(c)) : g.insertAfter(c), s.is("label") ? s.attr("for", t) : 0 === s.parents("label[for='" + t + "']").length && (n = s.attr("id"), C ? C.match(new RegExp("\b" + n + "\b")) || (C += " " + n) : C = n, d(c).attr("aria-describedby", C), k = this.groups[c.name], k && d.each(this.groups, function (c, e) {
                        e === k && d("[name='" + c + "']", this.currentForm).attr("aria-describedby",
                            s.attr("id"))
                    })));
                !e && this.settings.success && (s.text(""), "string" == typeof this.settings.success ? s.addClass(this.settings.success) : this.settings.success(s, c));
                this.toShow = this.toShow.add(s)
            }, errorsFor: function (c) {
                var e = this.idOrName(c);
                c = d(c).attr("aria-describedby");
                e = "label[for='" + e + "'], label[for='" + e + "'] *";
                return c && (e = e + ", #" + c.replace(/\s+/g, ", #")), this.errors().filter(e)
            }, idOrName: function (c) {
                return this.groups[c.name] || (this.checkable(c) ? c.name : c.id || c.name)
            }, validationTargetFor: function (c) {
                return this.checkable(c) &&
                (c = this.findByName(c.name).not(this.settings.ignore)[0]), c
            }, checkable: function (c) {
                return /radio|checkbox/i.test(c.type)
            }, findByName: function (c) {
                return d(this.currentForm).find("[name='" + c + "']")
            }, getLength: function (c, e) {
                switch (e.nodeName.toLowerCase()) {
                    case "select":
                        return d("option:selected", e).length;
                    case "input":
                        if (this.checkable(e))return this.findByName(e.name).filter(":checked").length
                }
                return c.length
            }, depend: function (c, d) {
                return this.dependTypes[typeof c] ? this.dependTypes[typeof c](c, d) : !0
            },
            dependTypes: {
                "boolean": function (c) {
                    return c
                }, string: function (c, e) {
                    return !!d(c, e.form).length
                }, "function": function (c, d) {
                    return c(d)
                }
            }, optional: function (c) {
                var e = this.elementValue(c);
                return !d.validator.methods.required.call(this, e, c) && "dependency-mismatch"
            }, startRequest: function (c) {
                this.pending[c.name] || (this.pendingRequest++, this.pending[c.name] = !0)
            }, stopRequest: function (c, e) {
                this.pendingRequest--;
                0 > this.pendingRequest && (this.pendingRequest = 0);
                delete this.pending[c.name];
                e && 0 === this.pendingRequest &&
                this.formSubmitted && this.form() ? (d(this.currentForm).submit(), this.formSubmitted = !1) : !e && 0 === this.pendingRequest && this.formSubmitted && (d(this.currentForm).triggerHandler("invalid-form", [this]), this.formSubmitted = !1)
            }, previousValue: function (c) {
                return d.data(c, "previousValue") || d.data(c, "previousValue", {
                        old: null,
                        valid: !0,
                        message: this.defaultMessage(c, "remote")
                    })
            }
        }, classRuleSettings: {
            required: {required: !0},
            email: {email: !0},
            url: {url: !0},
            date: {date: !0},
            dateISO: {dateISO: !0},
            number: {number: !0},
            digits: {digits: !0},
            creditcard: {creditcard: !0}
        }, addClassRules: function (c, e) {
            c.constructor === String ? this.classRuleSettings[c] = e : d.extend(this.classRuleSettings, c)
        }, classRules: function (c) {
            var e = {};
            c = d(c).attr("class");
            return c && d.each(c.split(" "), function () {
                this in d.validator.classRuleSettings && d.extend(e, d.validator.classRuleSettings[this])
            }), e
        }, attributeRules: function (c) {
            var e, g, k = {}, n = d(c), s = c.getAttribute("type");
            for (e in d.validator.methods)"required" === e ? (g = c.getAttribute(e), "" === g && (g = !0), g = !!g) : g = n.attr(e), /min|max/.test(e) &&
            (null === s || /number|range|text/.test(s)) && (g = Number(g)), g || 0 === g ? k[e] = g : s === e && "range" !== s && (k[e] = !0);
            return k.maxlength && /-1|2147483647|524288/.test(k.maxlength) && delete k.maxlength, k
        }, dataRules: function (c) {
            var e, g = {}, k = d(c);
            for (e in d.validator.methods)c = k.data("rule" + e.charAt(0).toUpperCase() + e.substring(1).toLowerCase()), void 0 !== c && (g[e] = c);
            return g
        }, staticRules: function (c) {
            var e = {}, g = d.data(c.form, "validator");
            return g.settings.rules && (e = d.validator.normalizeRule(g.settings.rules[c.name]) || {}),
                e
        }, normalizeRules: function (c, e) {
            return d.each(c, function (g, k) {
                if (!1 === k)return void delete c[g];
                if (k.param || k.depends) {
                    var n = !0;
                    switch (typeof k.depends) {
                        case "string":
                            n = !!d(k.depends, e.form).length;
                            break;
                        case "function":
                            n = k.depends.call(e, e)
                    }
                    n ? c[g] = void 0 !== k.param ? k.param : !0 : delete c[g]
                }
            }), d.each(c, function (g, k) {
                c[g] = d.isFunction(k) ? k(e) : k
            }), d.each(["minlength", "maxlength"], function () {
                c[this] && (c[this] = Number(c[this]))
            }), d.each(["rangelength", "range"], function () {
                var e;
                c[this] && (d.isArray(c[this]) ?
                    c[this] = [Number(c[this][0]), Number(c[this][1])] : "string" == typeof c[this] && (e = c[this].replace(/[\[\]]/g, "").split(/[\s,]+/), c[this] = [Number(e[0]), Number(e[1])]))
            }), d.validator.autoCreateRanges && (c.min && c.max && (c.range = [c.min, c.max], delete c.min, delete c.max), c.minlength && c.maxlength && (c.rangelength = [c.minlength, c.maxlength], delete c.minlength, delete c.maxlength)), c
        }, normalizeRule: function (c) {
            if ("string" == typeof c) {
                var e = {};
                d.each(c.split(/\s/), function () {
                    e[this] = !0
                });
                c = e
            }
            return c
        }, addMethod: function (c,
                                e, g) {
            d.validator.methods[c] = e;
            d.validator.messages[c] = void 0 !== g ? g : d.validator.messages[c];
            3 > e.length && d.validator.addClassRules(c, d.validator.normalizeRule(c))
        }, methods: {
            required: function (c, e, g) {
                return this.depend(g, e) ? "select" === e.nodeName.toLowerCase() ? (c = d(e).val()) && 0 < c.length : this.checkable(e) ? 0 < this.getLength(c, e) : 0 < d.trim(c).length : "dependency-mismatch"
            }, email: function (c, d) {
                return this.optional(d) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(c)
            },
            url: function (c, d) {
                return this.optional(d) || /^HTTP|HTTP|http(s)?:\/\/(www\.)?[A-Za-z0-9]+([\-\.]{1}[A-Za-z0-9]+)*\.[A-Za-z]{2,40}(:[0-9]{1,40})?(\/.*)?$/.test(c)
            }, date: function (c, d) {
                return this.optional(d) || !/Invalid|NaN/.test((new Date("" != c ? c.replace(/^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/, "$3$2$1$4$5") : c)).toString())
            }, dateISO: function (c, d) {
                return this.optional(d) || /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(c)
            }, number: function (c, d) {
                return this.optional(d) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(c)
            },
            digits: function (c, d) {
                return this.optional(d) || /^\d+$/.test(c)
            }, creditcard: function (c, d) {
                if (this.optional(d))return "dependency-mismatch";
                if (/[^0-9 \-]+/.test(c))return !1;
                var g, k, n = 0;
                k = 0;
                var s = !1;
                if (c = c.replace(/\D/g, ""), 13 > c.length || 19 < c.length)return !1;
                for (g = c.length - 1; 0 <= g; g--)k = c.charAt(g), k = parseInt(k, 10), s && 9 < (k *= 2) && (k -= 9), n += k, s = !s;
                return 0 === n % 10
            }, minlength: function (c, e, g) {
                c = d.isArray(c) ? c.length : this.getLength(d.trim(c), e);
                return this.optional(e) || c >= g
            }, maxlength: function (c, e, g) {
                c = d.isArray(c) ?
                    c.length : this.getLength(d.trim(c), e);
                return this.optional(e) || g >= c
            }, rangelength: function (c, e, g) {
                c = d.isArray(c) ? c.length : this.getLength(d.trim(c), e);
                return this.optional(e) || c >= g[0] && c <= g[1]
            }, min: function (c, d, g) {
                return this.optional(d) || c >= g
            }, max: function (c, d, g) {
                return this.optional(d) || g >= c
            }, range: function (c, d, g) {
                return this.optional(d) || c >= g[0] && c <= g[1]
            }, equalTo: function (c, e, g) {
                g = d(g);
                return this.settings.onfocusout && g.unbind(".validate-equalTo").bind("blur.validate-equalTo", function () {
                    d(e).valid()
                }),
                c === g.val()
            }, remote: function (c, e, g) {
                if (this.optional(e))return "dependency-mismatch";
                var k, n, s = this.previousValue(e);
                return this.settings.messages[e.name] || (this.settings.messages[e.name] = {}), s.originalMessage = this.settings.messages[e.name].remote, this.settings.messages[e.name].remote = s.message, g = "string" == typeof g && {url: g} || g, s.old === c ? s.valid : (s.old = c, k = this, this.startRequest(e), n = {}, n[e.name] = c, d.ajax(d.extend(!0, {
                    url: g, mode: "abort", port: "validate" + e.name, dataType: "json", data: n, context: k.currentForm,
                    success: function (g) {
                        var n, t, x, T = !0 === g || "true" === g;
                        k.settings.messages[e.name].remote = s.originalMessage;
                        T ? (x = k.formSubmitted, k.prepareElement(e), k.formSubmitted = x, k.successList.push(e), delete k.invalid[e.name], k.showErrors()) : (n = {}, t = g || k.defaultMessage(e, "remote"), n[e.name] = s.message = d.isFunction(t) ? t(c) : t, k.invalid[e.name] = !0, k.showErrors(n));
                        s.valid = T;
                        k.stopRequest(e, T)
                    }
                }, g)), "pending")
            }
        }
    });
    d.format = function () {
        throw"$.format has been deprecated. Please use $.validator.format instead.";
    };
    var n,
        t = {};
    d.ajaxPrefilter ? d.ajaxPrefilter(function (c, d, g) {
        d = c.port;
        "abort" === c.mode && (t[d] && t[d].abort(), t[d] = g)
    }) : (n = d.ajax, d.ajax = function (c) {
        var e = ("port" in c ? c : d.ajaxSettings).port;
        return "abort" === ("mode" in c ? c : d.ajaxSettings).mode ? (t[e] && t[e].abort(), t[e] = n.apply(this, arguments), t[e]) : n.apply(this, arguments)
    });
    d.extend(d.fn, {
        validateDelegate: function (c, e, g) {
            return this.bind(e, function (e) {
                var n = d(e.target);
                return n.is(c) ? g.apply(n, arguments) : void 0
            })
        }
    })
});
(function (d) {
    var n = !1, t = !1, c = 5E3, e = 2E3, g = 0, k = function () {
        var c = document.getElementsByTagName("script"), c = c[c.length - 1].src.split("?")[0];
        return 0 < c.split("/").length ? c.split("/").slice(0, -1).join("/") + "/" : ""
    }();
    Array.prototype.forEach || (Array.prototype.forEach = function (c, d) {
        for (var e = 0, g = this.length; e < g; ++e)c.call(d, this[e], e, this)
    });
    var x = window.requestAnimationFrame || !1, s = window.cancelAnimationFrame || !1;
    ["ms", "moz", "webkit", "o"].forEach(function (c) {
        x || (x = window[c + "RequestAnimationFrame"]);
        s || (s =
            window[c + "CancelAnimationFrame"] || window[c + "CancelRequestAnimationFrame"])
    });
    var G = window.MutationObserver || window.WebKitMutationObserver || !1, C = {
            zindex: "auto",
            cursoropacitymin: 0,
            cursoropacitymax: 1,
            cursorcolor: "#424242",
            cursorwidth: "5px",
            cursorborder: "1px solid #fff",
            cursorborderradius: "5px",
            scrollspeed: 60,
            mousescrollstep: 24,
            touchbehavior: !1,
            hwacceleration: !0,
            usetransition: !0,
            boxzoom: !1,
            dblclickzoom: !0,
            gesturezoom: !0,
            grabcursorenabled: !0,
            autohidemode: !0,
            background: "",
            iframeautoresize: !0,
            cursorminheight: 32,
            preservenativescrolling: !0,
            railoffset: !1,
            bouncescroll: !0,
            spacebarenabled: !0,
            railpadding: {top: 0, right: 0, left: 0, bottom: 0},
            disableoutline: !0,
            horizrailenabled: !0,
            railalign: "right",
            railvalign: "bottom",
            enabletranslate3d: !0,
            enablemousewheel: !0,
            enablekeyboard: !0,
            smoothscroll: !0,
            sensitiverail: !0,
            enablemouselockapi: !0,
            cursorfixedheight: !1,
            directionlockdeadzone: 6,
            hidecursordelay: 400,
            nativeparentscrolling: !0,
            enablescrollonselection: !0,
            overflowx: !0,
            overflowy: !0,
            cursordragspeed: .3,
            rtlmode: !1,
            cursordragontouch: !1
        },
        H = !1, P = function () {
            if (H)return H;
            var c = document.createElement("DIV"),
                d = {haspointerlock: "pointerLockElement" in document || "mozPointerLockElement" in document || "webkitPointerLockElement" in document};
            d.isopera = "opera" in window;
            d.isopera12 = d.isopera && "getUserMedia" in navigator;
            d.isie = "all" in document && "attachEvent" in c && !d.isopera;
            d.isieold = d.isie && !("msInterpolationMode" in c.style);
            d.isie7 = d.isie && !d.isieold && (!("documentMode" in document) || 7 == document.documentMode);
            d.isie8 = d.isie && "documentMode" in document &&
                8 == document.documentMode;
            d.isie9 = d.isie && "performance" in window && 9 <= document.documentMode;
            d.isie10 = d.isie && "performance" in window && 10 <= document.documentMode;
            d.isie9mobile = /iemobile.9/i.test(navigator.userAgent);
            d.isie9mobile && (d.isie9 = !1);
            d.isie7mobile = !d.isie9mobile && d.isie7 && /iemobile/i.test(navigator.userAgent);
            d.ismozilla = "MozAppearance" in c.style;
            d.iswebkit = "WebkitAppearance" in c.style;
            d.ischrome = "chrome" in window;
            d.ischrome22 = d.ischrome && d.haspointerlock;
            d.ischrome26 = d.ischrome && "transition" in
                c.style;
            d.cantouch = "ontouchstart" in document.documentElement || "ontouchstart" in window;
            d.hasmstouch = window.navigator.msPointerEnabled || !1;
            d.ismac = /^mac$/i.test(navigator.platform);
            d.isios = d.cantouch && /iphone|ipad|ipod/i.test(navigator.platform);
            d.isios4 = d.isios && !("seal" in Object);
            d.isandroid = /android/i.test(navigator.userAgent);
            d.trstyle = !1;
            d.hastransform = !1;
            d.hastranslate3d = !1;
            d.transitionstyle = !1;
            d.hastransition = !1;
            d.transitionend = !1;
            for (var e = ["transform", "msTransform", "webkitTransform", "MozTransform",
                "OTransform"], g = 0; g < e.length; g++)if ("undefined" != typeof c.style[e[g]]) {
                d.trstyle = e[g];
                break
            }
            d.hastransform = 0 != d.trstyle;
            d.hastransform && (c.style[d.trstyle] = "translate3d(1px,2px,3px)", d.hastranslate3d = /translate3d/.test(c.style[d.trstyle]));
            d.transitionstyle = !1;
            d.prefixstyle = "";
            d.transitionend = !1;
            for (var e = "transition webkitTransition MozTransition OTransition OTransition msTransition KhtmlTransition".split(" "), k = " -webkit- -moz- -o- -o -ms- -khtml-".split(" "), n = "transitionend webkitTransitionEnd transitionend otransitionend oTransitionEnd msTransitionEnd KhtmlTransitionEnd".split(" "),
                     g = 0; g < e.length; g++)if (e[g] in c.style) {
                d.transitionstyle = e[g];
                d.prefixstyle = k[g];
                d.transitionend = n[g];
                break
            }
            d.ischrome26 && (d.prefixstyle = k[1]);
            d.hastransition = d.transitionstyle;
            a:{
                e = ["-moz-grab", "-webkit-grab", "grab"];
                if (d.ischrome && !d.ischrome22 || d.isie) e = [];
                for (g = 0; g < e.length; g++)if (k = e[g], c.style.cursor = k, c.style.cursor == k) {
                    e = k;
                    break a
                }
                e = "url(http://www.google.com/intl/en_ALL/mapfiles/openhand.cur),n-resize"
            }
            d.cursorgrabvalue = e;
            d.hasmousecapture = "setCapture" in c;
            d.hasMutationObserver = !1 !== G;
            return H =
                d
        }, T = function (w, q) {
            function I() {
                var c = b.win;
                if ("zIndex" in c)return c.zIndex();
                for (; 0 < c.length && 9 != c[0].nodeType;) {
                    var d = c.css("zIndex");
                    if (!isNaN(d) && 0 != d)return parseInt(d);
                    c = c.parent()
                }
                return !1
            }

            function F(c, d, e) {
                d = c.css(d);
                c = parseFloat(d);
                return isNaN(c) ? (c = ga[d] || 0, e = 3 == c ? e ? b.win.outerHeight() - b.win.innerHeight() : b.win.outerWidth() - b.win.innerWidth() : 1, b.isie8 && c && (c += 1), e ? c : 0) : c
            }

            function L(c, d, e, g) {
                b._bind(c, d, function (b) {
                    b = b ? b : window.event;
                    var g = {
                        original: b,
                        target: b.target || b.srcElement,
                        type: "wheel",
                        deltaMode: "MozMousePixelScroll" == b.type ? 0 : 1,
                        deltaX: 0,
                        deltaZ: 0,
                        preventDefault: function () {
                            b.preventDefault ? b.preventDefault() : b.returnValue = !1;
                            return !1
                        },
                        stopImmediatePropagation: function () {
                            b.stopImmediatePropagation ? b.stopImmediatePropagation() : b.cancelBubble = !0
                        }
                    };
                    "mousewheel" == d ? (g.deltaY = -.025 * b.wheelDelta, b.wheelDeltaX && (g.deltaX = -.025 * b.wheelDeltaX)) : g.deltaY = b.detail;
                    return e.call(c, g)
                }, g)
            }

            function H(c, d, e) {
                var g, q;
                0 == c.deltaMode ? (g = -Math.floor(b.opt.mousescrollstep / 54 * c.deltaX), q = -Math.floor(b.opt.mousescrollstep /
                    54 * c.deltaY)) : 1 == c.deltaMode && (g = -Math.floor(c.deltaX * b.opt.mousescrollstep), q = -Math.floor(c.deltaY * b.opt.mousescrollstep));
                d && 0 == g && q && (g = q, q = 0);
                g && (b.scrollmom && b.scrollmom.stop(), b.lastdeltax += g, b.debounced("mousewheelx", function () {
                    var c = b.lastdeltax;
                    b.lastdeltax = 0;
                    b.rail.drag || b.doScrollLeftBy(c)
                }, 120));
                if (q) {
                    if (b.opt.nativeparentscrolling && e && !b.ispage && !b.zoomactive)if (0 > q) {
                        if (b.getScrollTop() >= b.page.maxh)return !0
                    } else if (0 >= b.getScrollTop())return !0;
                    b.scrollmom && b.scrollmom.stop();
                    b.lastdeltay +=
                        q;
                    b.debounced("mousewheely", function () {
                        var c = b.lastdeltay;
                        b.lastdeltay = 0;
                        b.rail.drag || b.doScrollBy(c)
                    }, 120)
                }
                c.stopImmediatePropagation();
                return c.preventDefault()
            }

            var b = this;
            this.version = "3.4.0";
            this.name = "nicescroll";
            this.me = q;
            this.opt = {doc: d("body"), win: !1};
            d.extend(this.opt, C);
            this.opt.snapbackspeed = 80;
            if (w)for (var ka in b.opt)"undefined" != typeof w[ka] && (b.opt[ka] = w[ka]);
            this.iddoc = (this.doc = b.opt.doc) && this.doc[0] ? this.doc[0].id || "" : "";
            this.ispage = /BODY|HTML/.test(b.opt.win ? b.opt.win[0].nodeName :
                this.doc[0].nodeName);
            this.haswrapper = !1 !== b.opt.win;
            this.win = b.opt.win || (this.ispage ? d(window) : this.doc);
            this.docscroll = this.ispage && !this.haswrapper ? d(window) : this.win;
            this.body = d("body");
            this.iframe = this.isfixed = this.viewport = !1;
            this.isiframe = "IFRAME" == this.doc[0].nodeName && "IFRAME" == this.win[0].nodeName;
            this.istextarea = "TEXTAREA" == this.win[0].nodeName;
            this.forcescreen = !1;
            this.canshowonmouseevent = "scroll" != b.opt.autohidemode;
            this.page = this.view = this.onzoomout = this.onzoomin = this.onscrollcancel =
                this.onscrollend = this.onscrollstart = this.onclick = this.ongesturezoom = this.onkeypress = this.onmousewheel = this.onmousemove = this.onmouseup = this.onmousedown = !1;
            this.scroll = {x: 0, y: 0};
            this.scrollratio = {x: 0, y: 0};
            this.cursorheight = 20;
            this.scrollvaluemax = 0;
            this.observerremover = this.observer = this.scrollmom = this.scrollrunning = this.checkrtlmode = !1;
            do this.id = "ascrail" + e++; while (document.getElementById(this.id));
            this.hasmousefocus = this.hasfocus = this.zoomactive = this.zoom = this.selectiondrag = this.cursorfreezed = this.cursor =
                this.rail = !1;
            this.visibility = !0;
            this.hidden = this.locked = !1;
            this.cursoractive = !0;
            this.overflowx = b.opt.overflowx;
            this.overflowy = b.opt.overflowy;
            this.nativescrollingarea = !1;
            this.checkarea = 0;
            this.events = [];
            this.saved = {};
            this.delaylist = {};
            this.synclist = {};
            this.lastdeltay = this.lastdeltax = 0;
            this.detected = P();
            var r = d.extend({}, this.detected);
            this.ishwscroll = (this.canhwscroll = r.hastransform && b.opt.hwacceleration) && b.haswrapper;
            this.istouchcapable = !1;
            r.cantouch && r.ischrome && !r.isios && !r.isandroid && (this.istouchcapable =
                !0, r.cantouch = !1);
            r.cantouch && r.ismozilla && !r.isios && (this.istouchcapable = !0, r.cantouch = !1);
            b.opt.enablemouselockapi || (r.hasmousecapture = !1, r.haspointerlock = !1);
            this.delayed = function (c, d, e, g) {
                var q = b.delaylist[c], k = (new Date).getTime();
                if (!g && q && q.tt)return !1;
                q && q.tt && clearTimeout(q.tt);
                q && q.last + e > k && !q.tt ? b.delaylist[c] = {
                    last: k + e, tt: setTimeout(function () {
                        b.delaylist[c].tt = 0;
                        d.call()
                    }, e)
                } : q && q.tt || (b.delaylist[c] = {last: k, tt: 0}, setTimeout(function () {
                        d.call()
                    }, 0))
            };
            this.debounced = function (c, d, e) {
                var g =
                    b.delaylist[c];
                (new Date).getTime();
                b.delaylist[c] = d;
                g || setTimeout(function () {
                    var d = b.delaylist[c];
                    b.delaylist[c] = !1;
                    d.call()
                }, e)
            };
            this.synched = function (c, d) {
                b.synclist[c] = d;
                (function () {
                    b.onsync || (x(function () {
                        b.onsync = !1;
                        for (c in b.synclist) {
                            var d = b.synclist[c];
                            d && d.call(b);
                            b.synclist[c] = !1
                        }
                    }), b.onsync = !0)
                })();
                return c
            };
            this.unsynched = function (c) {
                b.synclist[c] && (b.synclist[c] = !1)
            };
            this.css = function (c, d) {
                for (var e in d)b.saved.css.push([c, e, c.css(e)]), c.css(e, d[e])
            };
            this.scrollTop = function (c) {
                return "undefined" ==
                typeof c ? b.getScrollTop() : b.setScrollTop(c)
            };
            this.scrollLeft = function (c) {
                return "undefined" == typeof c ? b.getScrollLeft() : b.setScrollLeft(c)
            };
            BezierClass = function (b, c, d, e, g, q, k) {
                this.st = b;
                this.ed = c;
                this.spd = d;
                this.p1 = e || 0;
                this.p2 = g || 1;
                this.p3 = q || 0;
                this.p4 = k || 1;
                this.ts = (new Date).getTime();
                this.df = this.ed - this.st
            };
            BezierClass.prototype = {
                B2: function (b) {
                    return 3 * b * b * (1 - b)
                }, B3: function (b) {
                    return 3 * b * (1 - b) * (1 - b)
                }, B4: function (b) {
                    return (1 - b) * (1 - b) * (1 - b)
                }, getNow: function () {
                    var b = 1 - ((new Date).getTime() - this.ts) /
                        this.spd, c = this.B2(b) + this.B3(b) + this.B4(b);
                    return 0 > b ? this.ed : this.st + Math.round(this.df * c)
                }, update: function (b, c) {
                    this.st = this.getNow();
                    this.ed = b;
                    this.spd = c;
                    this.ts = (new Date).getTime();
                    this.df = this.ed - this.st;
                    return this
                }
            };
            if (this.ishwscroll) {
                this.doc.translate = {x: 0, y: 0, tx: "0px", ty: "0px"};
                r.hastranslate3d && r.isios && this.doc.css("-webkit-backface-visibility", "hidden");
                var z = function () {
                    var c = b.doc.css(r.trstyle);
                    return c && "matrix" == c.substr(0, 6) ? c.replace(/^.*\((.*)\)$/g, "$1").replace(/px/g, "").split(/, +/) :
                        !1
                };
                this.getScrollTop = function (c) {
                    if (!c) {
                        if (c = z())return 16 == c.length ? -c[13] : -c[5];
                        if (b.timerscroll && b.timerscroll.bz)return b.timerscroll.bz.getNow()
                    }
                    return b.doc.translate.y
                };
                this.getScrollLeft = function (c) {
                    if (!c) {
                        if (c = z())return 16 == c.length ? -c[12] : -c[4];
                        if (b.timerscroll && b.timerscroll.bh)return b.timerscroll.bh.getNow()
                    }
                    return b.doc.translate.x
                };
                this.notifyScrollEvent = document.createEvent ? function (b) {
                    var c = document.createEvent("UIEvents");
                    c.initUIEvent("scroll", !1, !0, window, 1);
                    b.dispatchEvent(c)
                } :
                    document.fireEvent ? function (b) {
                        var c = document.createEventObject();
                        b.fireEvent("onscroll");
                        c.cancelBubble = !0
                    } : function (b, c) {
                    };
                r.hastranslate3d && b.opt.enabletranslate3d ? (this.setScrollTop = function (c, d) {
                    b.doc.translate.y = c;
                    b.doc.translate.ty = -1 * c + "px";
                    b.doc.css(r.trstyle, "translate3d(" + b.doc.translate.tx + "," + b.doc.translate.ty + ",0px)");
                    d || b.notifyScrollEvent(b.win[0])
                }, this.setScrollLeft = function (c, d) {
                    b.doc.translate.x = c;
                    b.doc.translate.tx = -1 * c + "px";
                    b.doc.css(r.trstyle, "translate3d(" + b.doc.translate.tx +
                        "," + b.doc.translate.ty + ",0px)");
                    d || b.notifyScrollEvent(b.win[0])
                }) : (this.setScrollTop = function (c, d) {
                    b.doc.translate.y = c;
                    b.doc.translate.ty = -1 * c + "px";
                    b.doc.css(r.trstyle, "translate(" + b.doc.translate.tx + "," + b.doc.translate.ty + ")");
                    d || b.notifyScrollEvent(b.win[0])
                }, this.setScrollLeft = function (c, d) {
                    b.doc.translate.x = c;
                    b.doc.translate.tx = -1 * c + "px";
                    b.doc.css(r.trstyle, "translate(" + b.doc.translate.tx + "," + b.doc.translate.ty + ")");
                    d || b.notifyScrollEvent(b.win[0])
                })
            } else this.getScrollTop = function () {
                return b.docscroll.scrollTop()
            },
                this.setScrollTop = function (c) {
                    return b.docscroll.scrollTop(c)
                }, this.getScrollLeft = function () {
                return b.docscroll.scrollLeft()
            }, this.setScrollLeft = function (c) {
                return b.docscroll.scrollLeft(c)
            };
            this.getTarget = function (b) {
                return b ? b.target ? b.target : b.srcElement ? b.srcElement : !1 : !1
            };
            this.hasParent = function (b, c) {
                if (!b)return !1;
                for (var d = b.target || b.srcElement || b || !1; d && d.id != c;)d = d.parentNode || !1;
                return !1 !== d
            };
            var ga = {thin: 1, medium: 3, thick: 5};
            this.getOffset = function () {
                if (b.isfixed)return {
                    top: parseFloat(b.win.css("top")),
                    left: parseFloat(b.win.css("left"))
                };
                if (!b.viewport)return b.win.offset();
                var c = b.win.offset(), d = b.viewport.offset();
                return {top: c.top - d.top + b.viewport.scrollTop(), left: c.left - d.left + b.viewport.scrollLeft()}
            };
            this.updateScrollBar = function (c) {
                if (b.ishwscroll) b.rail.css({height: b.win.innerHeight()}), b.railh && b.railh.css({width: b.win.innerWidth()}); else {
                    var d = b.getOffset(), e = d.top, g = d.left, e = e + F(b.win, "border-top-width", !0);
                    b.win.outerWidth();
                    b.win.innerWidth();
                    var g = g + (b.rail.align ? b.win.outerWidth() -
                                F(b.win, "border-right-width") - b.rail.width : F(b.win, "border-left-width")),
                        q = b.opt.railoffset;
                    q && (q.top && (e += q.top), b.rail.align && q.left && (g += q.left));
                    b.locked || b.rail.css({top: e, left: g, height: c ? c.h : b.win.innerHeight()});
                    b.zoom && b.zoom.css({top: e + 1, left: 1 == b.rail.align ? g - 20 : g + b.rail.width + 4});
                    b.railh && !b.locked && (e = d.top, g = d.left, c = b.railh.align ? e + F(b.win, "border-top-width", !0) + b.win.innerHeight() - b.railh.height : e + F(b.win, "border-top-width", !0), g += F(b.win, "border-left-width"), b.railh.css({
                        top: c, left: g,
                        width: b.railh.width
                    }))
                }
            };
            this.doRailClick = function (c, d, e) {
                var g;
                b.locked || (b.cancelEvent(c), d ? (d = e ? b.doScrollLeft : b.doScrollTop, g = e ? (c.pageX - b.railh.offset().left - b.cursorwidth / 2) * b.scrollratio.x : (c.pageY - b.rail.offset().top - b.cursorheight / 2) * b.scrollratio.y, d(g)) : (d = e ? b.doScrollLeftBy : b.doScrollBy, g = e ? b.scroll.x : b.scroll.y, c = e ? c.pageX - b.railh.offset().left : c.pageY - b.rail.offset().top, e = e ? b.view.w : b.view.h, g >= c ? d(e) : d(-e)))
            };
            b.hasanimationframe = x;
            b.hascancelanimationframe = s;
            b.hasanimationframe ? b.hascancelanimationframe ||
                (s = function () {
                    b.cancelAnimationFrame = !0
                }) : (x = function (b) {
                return setTimeout(b, 15 - Math.floor(+new Date / 1E3) % 16)
            }, s = clearInterval);
            this.init = function () {
                b.saved.css = [];
                if (r.isie7mobile)return !0;
                r.hasmstouch && b.css(b.ispage ? d("html") : b.win, {"-ms-touch-action": "none"});
                b.zindex = "auto";
                b.zindex = b.ispage || "auto" != b.opt.zindex ? b.opt.zindex : I() || "auto";
                !b.ispage && "auto" != b.zindex && b.zindex > g && (g = b.zindex);
                b.isie && 0 == b.zindex && "auto" == b.opt.zindex && (b.zindex = "auto");
                if (!b.ispage || !r.cantouch && !r.isieold && !r.isie9mobile) {
                    var e =
                        b.docscroll;
                    b.ispage && (e = b.haswrapper ? b.win : b.doc);
                    r.isie9mobile || b.css(e, {"overflow-y": "hidden"});
                    b.ispage && r.isie7 && ("BODY" == b.doc[0].nodeName ? b.css(d("html"), {"overflow-y": "hidden"}) : "HTML" == b.doc[0].nodeName && b.css(d("body"), {"overflow-y": "hidden"}));
                    r.isios && !b.ispage && !b.haswrapper && b.css(d("body"), {"-webkit-overflow-scrolling": "touch"});
                    var q = d(document.createElement("div"));
                    q.css({
                        position: "relative",
                        top: 0,
                        "float": "right",
                        width: b.opt.cursorwidth,
                        height: "0px",
                        "background-color": b.opt.cursorcolor,
                        border: b.opt.cursorborder,
                        "background-clip": "padding-box",
                        "-webkit-border-radius": b.opt.cursorborderradius,
                        "-moz-border-radius": b.opt.cursorborderradius,
                        "border-radius": b.opt.cursorborderradius
                    });
                    q.hborder = parseFloat(q.outerHeight() - q.innerHeight());
                    b.cursor = q;
                    var w = d(document.createElement("div"));
                    w.attr("id", b.id);
                    w.addClass("nicescroll-rails");
                    var B, s, F = ["left", "right"], L;
                    for (L in F)s = F[L], (B = b.opt.railpadding[s]) ? w.css("padding-" + s, B + "px") : b.opt.railpadding[s] = 0;
                    w.append(q);
                    w.width = Math.max(parseFloat(b.opt.cursorwidth),
                            q.outerWidth()) + b.opt.railpadding.left + b.opt.railpadding.right;
                    w.css({width: w.width + "px", zIndex: b.zindex, background: b.opt.background, cursor: "default"});
                    w.visibility = !0;
                    w.scrollable = !0;
                    w.align = "left" == b.opt.railalign ? 0 : 1;
                    b.rail = w;
                    q = b.rail.drag = !1;
                    b.opt.boxzoom && !b.ispage && !r.isieold && (q = document.createElement("div"), b.bind(q, "click", b.doZoom), b.zoom = d(q), b.zoom.css({
                        cursor: "pointer",
                        "z-index": b.zindex,
                        backgroundImage: "url(" + k + "zoomico.png)",
                        height: 18,
                        width: 18,
                        backgroundPosition: "0px 0px"
                    }), b.opt.dblclickzoom &&
                    b.bind(b.win, "dblclick", b.doZoom), r.cantouch && b.opt.gesturezoom && (b.ongesturezoom = function (c) {
                        1.5 < c.scale && b.doZoomIn(c);
                        .8 > c.scale && b.doZoomOut(c);
                        return b.cancelEvent(c)
                    }, b.bind(b.win, "gestureend", b.ongesturezoom)));
                    b.railh = !1;
                    if (b.opt.horizrailenabled) {
                        b.css(e, {"overflow-x": "hidden"});
                        q = d(document.createElement("div"));
                        q.css({
                            position: "relative",
                            top: 0,
                            height: b.opt.cursorwidth,
                            width: "0px",
                            "background-color": b.opt.cursorcolor,
                            border: b.opt.cursorborder,
                            "background-clip": "padding-box",
                            "-webkit-border-radius": b.opt.cursorborderradius,
                            "-moz-border-radius": b.opt.cursorborderradius,
                            "border-radius": b.opt.cursorborderradius
                        });
                        q.wborder = parseFloat(q.outerWidth() - q.innerWidth());
                        b.cursorh = q;
                        var z = d(document.createElement("div"));
                        z.attr("id", b.id + "-hr");
                        z.addClass("nicescroll-rails");
                        z.height = Math.max(parseFloat(b.opt.cursorwidth), q.outerHeight());
                        z.css({height: z.height + "px", zIndex: b.zindex, background: b.opt.background});
                        z.append(q);
                        z.visibility = !0;
                        z.scrollable = !0;
                        z.align = "top" == b.opt.railvalign ? 0 : 1;
                        b.railh = z;
                        b.railh.drag = !1
                    }
                    b.ispage ?
                        (w.css({
                            position: "fixed",
                            top: "0px",
                            height: "100%"
                        }), w.align ? w.css({right: "0px"}) : w.css({left: "0px"}), b.body.append(w), b.railh && (z.css({
                            position: "fixed",
                            left: "0px",
                            width: "100%"
                        }), z.align ? z.css({bottom: "0px"}) : z.css({top: "0px"}), b.body.append(z))) : (b.ishwscroll ? ("static" == b.win.css("position") && b.css(b.win, {position: "relative"}), e = "HTML" == b.win[0].nodeName ? b.body : b.win, b.zoom && (b.zoom.css({
                        position: "absolute",
                        top: 1,
                        right: 0,
                        "margin-right": w.width + 4
                    }), e.append(b.zoom)), w.css({position: "absolute", top: 0}),
                        w.align ? w.css({right: 0}) : w.css({left: 0}), e.append(w), z && (z.css({
                        position: "absolute",
                        left: 0,
                        bottom: 0
                    }), z.align ? z.css({bottom: 0}) : z.css({top: 0}), e.append(z))) : (b.isfixed = "fixed" == b.win.css("position"), e = b.isfixed ? "fixed" : "absolute", b.isfixed || (b.viewport = b.getViewport(b.win[0])), b.viewport && (b.body = b.viewport, 0 == /relative|absolute/.test(b.viewport.css("position")) && b.css(b.viewport, {position: "relative"})), w.css({position: e}), b.zoom && b.zoom.css({position: e}), b.updateScrollBar(), b.body.append(w), b.zoom &&
                    b.body.append(b.zoom), b.railh && (z.css({position: e}), b.body.append(z))), r.isios && b.css(b.win, {
                        "-webkit-tap-highlight-color": "rgba(0,0,0,0)",
                        "-webkit-touch-callout": "none"
                    }), r.isie && b.opt.disableoutline && b.win.attr("hideFocus", "true"), r.iswebkit && b.opt.disableoutline && b.win.css({outline: "none"}));
                    !1 === b.opt.autohidemode ? (b.autohidedom = !1, b.rail.css({opacity: b.opt.cursoropacitymax}), b.railh && b.railh.css({opacity: b.opt.cursoropacitymax})) : !0 === b.opt.autohidemode ? (b.autohidedom = d().add(b.rail), r.isie8 &&
                    (b.autohidedom = b.autohidedom.add(b.cursor)), b.railh && (b.autohidedom = b.autohidedom.add(b.railh)), b.railh && r.isie8 && (b.autohidedom = b.autohidedom.add(b.cursorh))) : "scroll" == b.opt.autohidemode ? (b.autohidedom = d().add(b.rail), b.railh && (b.autohidedom = b.autohidedom.add(b.railh))) : "cursor" == b.opt.autohidemode ? (b.autohidedom = d().add(b.cursor), b.railh && (b.autohidedom = b.autohidedom.add(b.cursorh))) : "hidden" == b.opt.autohidemode && (b.autohidedom = !1, b.hide(), b.locked = !1);
                    if (r.isie9mobile) b.scrollmom = new ea(b), b.onmangotouch =
                        function (c) {
                            c = b.getScrollTop();
                            var d = b.getScrollLeft();
                            if (c == b.scrollmom.lastscrolly && d == b.scrollmom.lastscrollx)return !0;
                            var e = c - b.mangotouch.sy, g = d - b.mangotouch.sx;
                            if (0 != Math.round(Math.sqrt(Math.pow(g, 2) + Math.pow(e, 2)))) {
                                var l = 0 > e ? -1 : 1, q = 0 > g ? -1 : 1, k = +new Date;
                                b.mangotouch.lazy && clearTimeout(b.mangotouch.lazy);
                                80 < k - b.mangotouch.tm || b.mangotouch.dry != l || b.mangotouch.drx != q ? (b.scrollmom.stop(), b.scrollmom.reset(d, c), b.mangotouch.sy = c, b.mangotouch.ly = c, b.mangotouch.sx = d, b.mangotouch.lx = d, b.mangotouch.dry =
                                    l, b.mangotouch.drx = q, b.mangotouch.tm = k) : (b.scrollmom.stop(), b.scrollmom.update(b.mangotouch.sx - g, b.mangotouch.sy - e), b.mangotouch.tm = k, e = Math.max(Math.abs(b.mangotouch.ly - c), Math.abs(b.mangotouch.lx - d)), b.mangotouch.ly = c, b.mangotouch.lx = d, 2 < e && (b.mangotouch.lazy = setTimeout(function () {
                                    b.mangotouch.lazy = !1;
                                    b.mangotouch.dry = 0;
                                    b.mangotouch.drx = 0;
                                    b.mangotouch.tm = 0;
                                    b.scrollmom.doMomentum(30)
                                }, 100)))
                            }
                        }, w = b.getScrollTop(), z = b.getScrollLeft(), b.mangotouch = {
                        sy: w,
                        ly: w,
                        dry: 0,
                        sx: z,
                        lx: z,
                        drx: 0,
                        lazy: !1,
                        tm: 0
                    }, b.bind(b.docscroll,
                        "scroll", b.onmangotouch); else {
                        if (r.cantouch || b.istouchcapable || b.opt.touchbehavior || r.hasmstouch) {
                            b.scrollmom = new ea(b);
                            b.ontouchstart = function (c) {
                                if (c.pointerType && 2 != c.pointerType)return !1;
                                if (!b.locked) {
                                    if (r.hasmstouch)for (var e = c.target ? c.target : !1; e;) {
                                        var g = d(e).getNiceScroll();
                                        if (0 < g.length && g[0].me == b.me)break;
                                        if (0 < g.length)return !1;
                                        if ("DIV" == e.nodeName && e.id == b.id)break;
                                        e = e.parentNode ? e.parentNode : !1
                                    }
                                    b.cancelScroll();
                                    if ((e = b.getTarget(c)) && /INPUT/i.test(e.nodeName) && /range/i.test(e.type))return b.stopPropagation(c);
                                    !("clientX" in c) && "changedTouches" in c && (c.clientX = c.changedTouches[0].clientX, c.clientY = c.changedTouches[0].clientY);
                                    b.forcescreen && (g = c, c = {original: c.original ? c.original : c}, c.clientX = g.screenX, c.clientY = g.screenY);
                                    b.rail.drag = {
                                        x: c.clientX,
                                        y: c.clientY,
                                        sx: b.scroll.x,
                                        sy: b.scroll.y,
                                        st: b.getScrollTop(),
                                        sl: b.getScrollLeft(),
                                        pt: 2,
                                        dl: !1
                                    };
                                    if (b.ispage || !b.opt.directionlockdeadzone) b.rail.drag.dl = "f"; else {
                                        var g = d(window).width(), l = d(window).height(),
                                            q = Math.max(document.body.scrollWidth, document.documentElement.scrollWidth),
                                            k = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight),
                                            l = Math.max(0, k - l), g = Math.max(0, q - g);
                                        b.rail.drag.ck = !b.rail.scrollable && b.railh.scrollable ? 0 < l ? "v" : !1 : b.rail.scrollable && !b.railh.scrollable ? 0 < g ? "h" : !1 : !1;
                                        b.rail.drag.ck || (b.rail.drag.dl = "f")
                                    }
                                    b.opt.touchbehavior && b.isiframe && r.isie && (g = b.win.position(), b.rail.drag.x += g.left, b.rail.drag.y += g.top);
                                    b.hasmoving = !1;
                                    b.lastmouseup = !1;
                                    b.scrollmom.reset(c.clientX, c.clientY);
                                    if (!r.cantouch && !this.istouchcapable && !r.hasmstouch) {
                                        if (!e ||
                                            !/INPUT|SELECT|TEXTAREA/i.test(e.nodeName))return !b.ispage && r.hasmousecapture && e.setCapture(), b.cancelEvent(c);
                                        /SUBMIT|CANCEL|BUTTON/i.test(d(e).attr("type")) && (pc = {
                                            tg: e,
                                            click: !1
                                        }, b.preventclick = pc)
                                    }
                                }
                            };
                            b.ontouchend = function (c) {
                                if (c.pointerType && 2 != c.pointerType)return !1;
                                if (b.rail.drag && 2 == b.rail.drag.pt && (b.scrollmom.doMomentum(), b.rail.drag = !1, b.hasmoving && (b.hasmoving = !1, b.lastmouseup = !0, b.hideCursor(), r.hasmousecapture && document.releaseCapture(), !r.cantouch)))return b.cancelEvent(c)
                            };
                            var x = b.opt.touchbehavior &&
                                b.isiframe && !r.hasmousecapture;
                            b.ontouchmove = function (c, e) {
                                if (c.pointerType && 2 != c.pointerType)return !1;
                                if (b.rail.drag && 2 == b.rail.drag.pt) {
                                    if (r.cantouch && "undefined" == typeof c.original)return !0;
                                    b.hasmoving = !0;
                                    b.preventclick && !b.preventclick.click && (b.preventclick.click = b.preventclick.tg.onclick || !1, b.preventclick.tg.onclick = b.onpreventclick);
                                    c = d.extend({original: c}, c);
                                    "changedTouches" in c && (c.clientX = c.changedTouches[0].clientX, c.clientY = c.changedTouches[0].clientY);
                                    if (b.forcescreen) {
                                        var g = c;
                                        c = {
                                            original: c.original ?
                                                c.original : c
                                        };
                                        c.clientX = g.screenX;
                                        c.clientY = g.screenY
                                    }
                                    g = ofy = 0;
                                    if (x && !e) {
                                        var l = b.win.position(), g = -l.left;
                                        ofy = -l.top
                                    }
                                    var q = c.clientY + ofy, l = q - b.rail.drag.y, k = c.clientX + g,
                                        n = k - b.rail.drag.x, f = b.rail.drag.st - l;
                                    b.ishwscroll && b.opt.bouncescroll ? 0 > f ? f = Math.round(f / 2) : f > b.page.maxh && (f = b.page.maxh + Math.round((f - b.page.maxh) / 2)) : (0 > f && (q = f = 0), f > b.page.maxh && (f = b.page.maxh, q = 0));
                                    if (b.railh && b.railh.scrollable) {
                                        var v = b.rail.drag.sl - n;
                                        b.ishwscroll && b.opt.bouncescroll ? 0 > v ? v = Math.round(v / 2) : v > b.page.maxw && (v = b.page.maxw +
                                                Math.round((v - b.page.maxw) / 2)) : (0 > v && (k = v = 0), v > b.page.maxw && (v = b.page.maxw, k = 0))
                                    }
                                    g = !1;
                                    if (b.rail.drag.dl) g = !0, "v" == b.rail.drag.dl ? v = b.rail.drag.sl : "h" == b.rail.drag.dl && (f = b.rail.drag.st); else {
                                        var l = Math.abs(l), n = Math.abs(n), w = b.opt.directionlockdeadzone;
                                        if ("v" == b.rail.drag.ck) {
                                            if (l > w && n <= .3 * l)return b.rail.drag = !1, !0;
                                            n > w && (b.rail.drag.dl = "f", d("body").scrollTop(d("body").scrollTop()))
                                        } else if ("h" == b.rail.drag.ck) {
                                            if (n > w && l <= .3 * az)return b.rail.drag = !1, !0;
                                            l > w && (b.rail.drag.dl = "f", d("body").scrollLeft(d("body").scrollLeft()))
                                        }
                                    }
                                    b.synched("touchmove",
                                        function () {
                                            b.rail.drag && 2 == b.rail.drag.pt && (b.prepareTransition && b.prepareTransition(0), b.rail.scrollable && b.setScrollTop(f), b.scrollmom.update(k, q), b.railh && b.railh.scrollable ? (b.setScrollLeft(v), b.showCursor(f, v)) : b.showCursor(f), r.isie10 && document.selection.clear())
                                        });
                                    r.ischrome && b.istouchcapable && (g = !1);
                                    if (g)return b.cancelEvent(c)
                                }
                            }
                        }
                        b.onmousedown = function (c, d) {
                            if (!b.rail.drag || 1 == b.rail.drag.pt) {
                                if (b.locked)return b.cancelEvent(c);
                                b.cancelScroll();
                                b.rail.drag = {
                                    x: c.clientX, y: c.clientY, sx: b.scroll.x,
                                    sy: b.scroll.y, pt: 1, hr: !!d
                                };
                                var e = b.getTarget(c);
                                !b.ispage && r.hasmousecapture && e.setCapture();
                                b.isiframe && !r.hasmousecapture && (b.saved.csspointerevents = b.doc.css("pointer-events"), b.css(b.doc, {"pointer-events": "none"}));
                                return b.cancelEvent(c)
                            }
                        };
                        b.onmouseup = function (c) {
                            if (b.rail.drag && (r.hasmousecapture && document.releaseCapture(), b.isiframe && !r.hasmousecapture && b.doc.css("pointer-events", b.saved.csspointerevents), 1 == b.rail.drag.pt))return b.rail.drag = !1, b.cancelEvent(c)
                        };
                        b.onmousemove = function (c) {
                            if (b.rail.drag &&
                                1 == b.rail.drag.pt) {
                                if (r.ischrome && 0 == c.which)return b.onmouseup(c);
                                b.cursorfreezed = !0;
                                if (b.rail.drag.hr) {
                                    b.scroll.x = b.rail.drag.sx + (c.clientX - b.rail.drag.x);
                                    0 > b.scroll.x && (b.scroll.x = 0);
                                    var d = b.scrollvaluemaxw;
                                    b.scroll.x > d && (b.scroll.x = d)
                                } else b.scroll.y = b.rail.drag.sy + (c.clientY - b.rail.drag.y), 0 > b.scroll.y && (b.scroll.y = 0), d = b.scrollvaluemax, b.scroll.y > d && (b.scroll.y = d);
                                b.synched("mousemove", function () {
                                    b.rail.drag && 1 == b.rail.drag.pt && (b.showCursor(), b.rail.drag.hr ? b.doScrollLeft(Math.round(b.scroll.x *
                                        b.scrollratio.x), b.opt.cursordragspeed) : b.doScrollTop(Math.round(b.scroll.y * b.scrollratio.y), b.opt.cursordragspeed))
                                });
                                return b.cancelEvent(c)
                            }
                        };
                        if (r.cantouch || b.opt.touchbehavior) b.onpreventclick = function (c) {
                            if (b.preventclick)return b.preventclick.tg.onclick = b.preventclick.click, b.preventclick = !1, b.cancelEvent(c)
                        }, b.bind(b.win, "mousedown", b.ontouchstart), b.onclick = r.isios ? !1 : function (c) {
                            return b.lastmouseup ? (b.lastmouseup = !1, b.cancelEvent(c)) : !0
                        }, b.opt.grabcursorenabled && r.cursorgrabvalue && (b.css(b.ispage ?
                            b.doc : b.win, {cursor: r.cursorgrabvalue}), b.css(b.rail, {cursor: r.cursorgrabvalue})); else {
                            var V = function (c) {
                                if (b.selectiondrag) {
                                    if (c) {
                                        var d = b.win.outerHeight();
                                        c = c.pageY - b.selectiondrag.top;
                                        0 < c && c < d && (c = 0);
                                        c >= d && (c -= d);
                                        b.selectiondrag.df = c
                                    }
                                    0 != b.selectiondrag.df && (b.doScrollBy(2 * -Math.floor(b.selectiondrag.df / 6)), b.debounced("doselectionscroll", function () {
                                        V()
                                    }, 50))
                                }
                            };
                            b.hasTextSelected = "getSelection" in document ? function () {
                                return 0 < document.getSelection().rangeCount
                            } : "selection" in document ? function () {
                                return "None" !=
                                    document.selection.type
                            } : function () {
                                return !1
                            };
                            b.onselectionstart = function (c) {
                                b.ispage || (b.selectiondrag = b.win.offset())
                            };
                            b.onselectionend = function (c) {
                                b.selectiondrag = !1
                            };
                            b.onselectiondrag = function (c) {
                                b.selectiondrag && b.hasTextSelected() && b.debounced("selectionscroll", function () {
                                    V(c)
                                }, 250)
                            }
                        }
                        r.hasmstouch && (b.css(b.rail, {"-ms-touch-action": "none"}), b.css(b.cursor, {"-ms-touch-action": "none"}), b.bind(b.win, "MSPointerDown", b.ontouchstart), b.bind(document, "MSPointerUp", b.ontouchend), b.bind(document, "MSPointerMove",
                            b.ontouchmove), b.bind(b.cursor, "MSGestureHold", function (b) {
                            b.preventDefault()
                        }), b.bind(b.cursor, "contextmenu", function (b) {
                            b.preventDefault()
                        }));
                        this.istouchcapable && (b.bind(b.win, "touchstart", b.ontouchstart), b.bind(document, "touchend", b.ontouchend), b.bind(document, "touchcancel", b.ontouchend), b.bind(document, "touchmove", b.ontouchmove));
                        b.bind(b.cursor, "mousedown", b.onmousedown);
                        b.bind(b.cursor, "mouseup", b.onmouseup);
                        b.railh && (b.bind(b.cursorh, "mousedown", function (c) {
                            b.onmousedown(c, !0)
                        }), b.bind(b.cursorh,
                            "mouseup", function (c) {
                                if (!b.rail.drag || 2 != b.rail.drag.pt)return b.rail.drag = !1, b.hasmoving = !1, b.hideCursor(), r.hasmousecapture && document.releaseCapture(), b.cancelEvent(c)
                            }));
                        if (b.opt.cursordragontouch || !r.cantouch && !b.opt.touchbehavior) b.rail.css({cursor: "default"}), b.railh && b.railh.css({cursor: "default"}), b.jqbind(b.rail, "mouseenter", function () {
                            b.canshowonmouseevent && b.showCursor();
                            b.rail.active = !0
                        }), b.jqbind(b.rail, "mouseleave", function () {
                            b.rail.active = !1;
                            b.rail.drag || b.hideCursor()
                        }), b.opt.sensitiverail &&
                        (b.bind(b.rail, "click", function (c) {
                            b.doRailClick(c, !1, !1)
                        }), b.bind(b.rail, "dblclick", function (c) {
                            b.doRailClick(c, !0, !1)
                        }), b.bind(b.cursor, "click", function (c) {
                            b.cancelEvent(c)
                        }), b.bind(b.cursor, "dblclick", function (c) {
                            b.cancelEvent(c)
                        })), b.railh && (b.jqbind(b.railh, "mouseenter", function () {
                            b.canshowonmouseevent && b.showCursor();
                            b.rail.active = !0
                        }), b.jqbind(b.railh, "mouseleave", function () {
                            b.rail.active = !1;
                            b.rail.drag || b.hideCursor()
                        }), b.opt.sensitiverail && (b.bind(b.railh, "click", function (c) {
                            b.doRailClick(c,
                                !1, !0)
                        }), b.bind(b.railh, "dblclick", function (c) {
                            b.doRailClick(c, !0, !0)
                        }), b.bind(b.cursorh, "click", function (c) {
                            b.cancelEvent(c)
                        }), b.bind(b.cursorh, "dblclick", function (c) {
                            b.cancelEvent(c)
                        })));
                        r.cantouch || b.opt.touchbehavior ? (b.bind(r.hasmousecapture ? b.win : document, "mouseup", b.ontouchend), b.bind(document, "mousemove", b.ontouchmove), b.onclick && b.bind(document, "click", b.onclick), b.opt.cursordragontouch && (b.bind(b.cursor, "mousedown", b.onmousedown), b.bind(b.cursor, "mousemove", b.onmousemove), b.cursorh && b.bind(b.cursorh,
                            "mousedown", b.onmousedown), b.cursorh && b.bind(b.cursorh, "mousemove", b.onmousemove))) : (b.bind(r.hasmousecapture ? b.win : document, "mouseup", b.onmouseup), b.bind(document, "mousemove", b.onmousemove), b.onclick && b.bind(document, "click", b.onclick), !b.ispage && b.opt.enablescrollonselection && (b.bind(b.win[0], "mousedown", b.onselectionstart), b.bind(document, "mouseup", b.onselectionend), b.bind(b.cursor, "mouseup", b.onselectionend), b.cursorh && b.bind(b.cursorh, "mouseup", b.onselectionend), b.bind(document, "mousemove", b.onselectiondrag)),
                        b.zoom && (b.jqbind(b.zoom, "mouseenter", function () {
                            b.canshowonmouseevent && b.showCursor();
                            b.rail.active = !0
                        }), b.jqbind(b.zoom, "mouseleave", function () {
                            b.rail.active = !1;
                            b.rail.drag || b.hideCursor()
                        })));
                        b.opt.enablemousewheel && (b.isiframe || b.bind(r.isie && b.ispage ? document : b.docscroll, "mousewheel", b.onmousewheel), b.bind(b.rail, "mousewheel", b.onmousewheel), b.railh && b.bind(b.railh, "mousewheel", b.onmousewheelhr));
                        b.ispage || r.cantouch || /HTML|BODY/.test(b.win[0].nodeName) || (b.win.attr("tabindex") || b.win.attr({tabindex: c++}),
                            b.jqbind(b.win, "focus", function (c) {
                                n = b.getTarget(c).id || !0;
                                b.hasfocus = !0;
                                b.canshowonmouseevent && b.noticeCursor()
                            }), b.jqbind(b.win, "blur", function (c) {
                            n = !1;
                            b.hasfocus = !1
                        }), b.jqbind(b.win, "mouseenter", function (c) {
                            t = b.getTarget(c).id || !0;
                            b.hasmousefocus = !0;
                            b.canshowonmouseevent && b.noticeCursor()
                        }), b.jqbind(b.win, "mouseleave", function () {
                            t = !1;
                            b.hasmousefocus = !1
                        }))
                    }
                    b.onkeypress = function (c) {
                        if (b.locked && 0 == b.page.maxh)return !0;
                        c = c ? c : window.e;
                        var d = b.getTarget(c);
                        if (d && /INPUT|TEXTAREA|SELECT|OPTION/.test(d.nodeName) &&
                            (!d.getAttribute("type") && !d.type || !/submit|button|cancel/i.tp))return !0;
                        if (b.hasfocus || b.hasmousefocus && !n || b.ispage && !n && !t) {
                            d = c.keyCode;
                            if (b.locked && 27 != d)return b.cancelEvent(c);
                            var e = c.ctrlKey || !1, g = c.shiftKey || !1, l = !1;
                            switch (d) {
                                case 38:
                                case 63233:
                                    b.doScrollBy(72);
                                    l = !0;
                                    break;
                                case 40:
                                case 63235:
                                    b.doScrollBy(-72);
                                    l = !0;
                                    break;
                                case 37:
                                case 63232:
                                    b.railh && (e ? b.doScrollLeft(0) : b.doScrollLeftBy(72), l = !0);
                                    break;
                                case 39:
                                case 63234:
                                    b.railh && (e ? b.doScrollLeft(b.page.maxw) : b.doScrollLeftBy(-72), l = !0);
                                    break;
                                case 33:
                                case 63276:
                                    b.doScrollBy(b.view.h);
                                    l = !0;
                                    break;
                                case 34:
                                case 63277:
                                    b.doScrollBy(-b.view.h);
                                    l = !0;
                                    break;
                                case 36:
                                case 63273:
                                    b.railh && e ? b.doScrollPos(0, 0) : b.doScrollTo(0);
                                    l = !0;
                                    break;
                                case 35:
                                case 63275:
                                    b.railh && e ? b.doScrollPos(b.page.maxw, b.page.maxh) : b.doScrollTo(b.page.maxh);
                                    l = !0;
                                    break;
                                case 32:
                                    b.opt.spacebarenabled && (g ? b.doScrollBy(b.view.h) : b.doScrollBy(-b.view.h), l = !0);
                                    break;
                                case 27:
                                    b.zoomactive && (b.doZoom(), l = !0)
                            }
                            if (l)return b.cancelEvent(c)
                        }
                    };
                    b.opt.enablekeyboard && b.bind(document, r.isopera &&
                    !r.isopera12 ? "keypress" : "keydown", b.onkeypress);
                    b.bind(window, "resize", b.lazyResize);
                    b.bind(window, "orientationchange", b.lazyResize);
                    b.bind(window, "load", b.lazyResize);
                    if (r.ischrome && !b.ispage && !b.haswrapper) {
                        var C = b.win.attr("style"), w = parseFloat(b.win.css("width")) + 1;
                        b.win.css("width", w);
                        b.synched("chromefix", function () {
                            b.win.attr("style", C)
                        })
                    }
                    b.onAttributeChange = function (c) {
                        b.lazyResize(250)
                    };
                    !b.ispage && !b.haswrapper && (!1 !== G ? (b.observer = new G(function (c) {
                        c.forEach(b.onAttributeChange)
                    }), b.observer.observe(b.win[0],
                        {
                            childList: !0,
                            characterData: !1,
                            attributes: !0,
                            subtree: !1
                        }), b.observerremover = new G(function (c) {
                        c.forEach(function (c) {
                            if (0 < c.removedNodes.length)for (var d in c.removedNodes)if (c.removedNodes[d] == b.win[0])return b.remove()
                        })
                    }), b.observerremover.observe(b.win[0].parentNode, {
                        childList: !0,
                        characterData: !1,
                        attributes: !1,
                        subtree: !1
                    })) : (b.bind(b.win, r.isie && !r.isie9 ? "propertychange" : "DOMAttrModified", b.onAttributeChange), r.isie9 && b.win[0].attachEvent("onpropertychange", b.onAttributeChange), b.bind(b.win, "DOMNodeRemoved",
                        function (c) {
                            c.target == b.win[0] && b.remove()
                        })));
                    !b.ispage && b.opt.boxzoom && b.bind(window, "resize", b.resizeZoom);
                    b.istextarea && b.bind(b.win, "mouseup", b.lazyResize);
                    b.checkrtlmode = !0;
                    b.lazyResize(30)
                }
                if ("IFRAME" == this.doc[0].nodeName) {
                    var H = function (c) {
                        b.iframexd = !1;
                        try {
                            var e = "contentDocument" in this ? this.contentDocument : this.contentWindow.document
                        } catch (g) {
                            b.iframexd = !0, e = !1
                        }
                        if (b.iframexd)return "console" in window && console.log("NiceScroll error: policy restriced iframe"), !0;
                        b.forcescreen = !0;
                        b.isiframe &&
                        (b.iframe = {
                            doc: d(e),
                            html: b.doc.contents().find("html")[0],
                            body: b.doc.contents().find("body")[0]
                        }, b.getContentSize = function () {
                            return {
                                w: Math.max(b.iframe.html.scrollWidth, b.iframe.body.scrollWidth),
                                h: Math.max(b.iframe.html.scrollHeight, b.iframe.body.scrollHeight)
                            }
                        }, b.docscroll = d(b.iframe.body));
                        !r.isios && b.opt.iframeautoresize && !b.isiframe && (b.win.scrollTop(0), b.doc.height(""), c = Math.max(e.getElementsByTagName("html")[0].scrollHeight, e.body.scrollHeight), b.doc.height(c));
                        b.lazyResize(30);
                        r.isie7 && b.css(d(b.iframe.html),
                            {"overflow-y": "hidden"});
                        b.css(d(b.iframe.body), {"overflow-y": "hidden"});
                        "contentWindow" in this ? b.bind(this.contentWindow, "scroll", b.onscroll) : b.bind(e, "scroll", b.onscroll);
                        b.opt.enablemousewheel && b.bind(e, "mousewheel", b.onmousewheel);
                        b.opt.enablekeyboard && b.bind(e, r.isopera ? "keypress" : "keydown", b.onkeypress);
                        if (r.cantouch || b.opt.touchbehavior) b.bind(e, "mousedown", b.onmousedown), b.bind(e, "mousemove", function (c) {
                            b.onmousemove(c, !0)
                        }), b.opt.grabcursorenabled && r.cursorgrabvalue && b.css(d(e.body), {cursor: r.cursorgrabvalue});
                        b.bind(e, "mouseup", b.onmouseup);
                        b.zoom && (b.opt.dblclickzoom && b.bind(e, "dblclick", b.doZoom), b.ongesturezoom && b.bind(e, "gestureend", b.ongesturezoom))
                    };
                    this.doc[0].readyState && "complete" == this.doc[0].readyState && setTimeout(function () {
                        H.call(b.doc[0], !1)
                    }, 500);
                    b.bind(this.doc, "load", H)
                }
            };
            this.showCursor = function (c, d) {
                b.cursortimeout && (clearTimeout(b.cursortimeout), b.cursortimeout = 0);
                b.rail && (b.autohidedom && (b.autohidedom.stop().css({opacity: b.opt.cursoropacitymax}), b.cursoractive = !0), b.rail.drag && 1 ==
                b.rail.drag.pt || ("undefined" != typeof c && !1 !== c && (b.scroll.y = Math.round(1 * c / b.scrollratio.y)), "undefined" != typeof d && (b.scroll.x = Math.round(1 * d / b.scrollratio.x))), b.cursor.css({
                    height: b.cursorheight,
                    top: b.scroll.y
                }), b.cursorh && (!b.rail.align && b.rail.visibility ? b.cursorh.css({
                    width: b.cursorwidth,
                    left: b.scroll.x + b.rail.width
                }) : b.cursorh.css({
                    width: b.cursorwidth,
                    left: b.scroll.x
                }), b.cursoractive = !0), b.zoom && b.zoom.stop().css({opacity: b.opt.cursoropacitymax}))
            };
            this.hideCursor = function (c) {
                !b.cursortimeout &&
                b.rail && b.autohidedom && (b.cursortimeout = setTimeout(function () {
                    b.rail.active && b.showonmouseevent || (b.autohidedom.stop().animate({opacity: b.opt.cursoropacitymin}), b.zoom && b.zoom.stop().animate({opacity: b.opt.cursoropacitymin}), b.cursoractive = !1);
                    b.cursortimeout = 0
                }, c || b.opt.hidecursordelay))
            };
            this.noticeCursor = function (c, d, e) {
                b.showCursor(d, e);
                b.rail.active || b.hideCursor(c)
            };
            this.getContentSize = b.ispage ? function () {
                return {
                    w: Math.max(document.body.scrollWidth, document.documentElement.scrollWidth),
                    h: Math.max(document.body.scrollHeight,
                        document.documentElement.scrollHeight)
                }
            } : b.haswrapper ? function () {
                return {
                    w: b.doc.outerWidth() + parseInt(b.win.css("paddingLeft")) + parseInt(b.win.css("paddingRight")),
                    h: b.doc.outerHeight() + parseInt(b.win.css("paddingTop")) + parseInt(b.win.css("paddingBottom"))
                }
            } : function () {
                return {w: b.docscroll[0].scrollWidth, h: b.docscroll[0].scrollHeight}
            };
            this.onResize = function (c, d) {
                if (!b.win)return !1;
                if (!b.haswrapper && !b.ispage) {
                    if ("none" == b.win.css("display"))return b.visibility && b.hideRail().hideRailHr(), !1;
                    b.hidden ||
                    b.visibility || b.showRail().showRailHr()
                }
                var e = b.page.maxh, g = b.page.maxw, q = b.view.w;
                b.view = {
                    w: b.ispage ? b.win.width() : parseInt(b.win[0].clientWidth),
                    h: b.ispage ? b.win.height() : parseInt(b.win[0].clientHeight)
                };
                b.page = d ? d : b.getContentSize();
                b.page.maxh = Math.max(0, b.page.h - b.view.h);
                b.page.maxw = Math.max(0, b.page.w - b.view.w);
                if (b.page.maxh == e && b.page.maxw == g && b.view.w == q) {
                    if (b.ispage)return b;
                    e = b.win.offset();
                    if (b.lastposition && (g = b.lastposition, g.top == e.top && g.left == e.left))return b;
                    b.lastposition = e
                }
                0 ==
                b.page.maxh ? (b.hideRail(), b.scrollvaluemax = 0, b.scroll.y = 0, b.scrollratio.y = 0, b.cursorheight = 0, b.setScrollTop(0), b.rail.scrollable = !1) : b.rail.scrollable = !0;
                0 == b.page.maxw ? (b.hideRailHr(), b.scrollvaluemaxw = 0, b.scroll.x = 0, b.scrollratio.x = 0, b.cursorwidth = 0, b.setScrollLeft(0), b.railh.scrollable = !1) : b.railh.scrollable = !0;
                b.locked = 0 == b.page.maxh && 0 == b.page.maxw;
                if (b.locked)return b.ispage || b.updateScrollBar(b.view), !1;
                b.hidden || b.visibility ? !b.hidden && !b.railh.visibility && b.showRailHr() : b.showRail().showRailHr();
                b.istextarea && b.win.css("resize") && "none" != b.win.css("resize") && (b.view.h -= 20);
                b.cursorheight = Math.min(b.view.h, Math.round(b.view.h / b.page.h * b.view.h));
                b.cursorheight = b.opt.cursorfixedheight ? b.opt.cursorfixedheight : Math.max(b.opt.cursorminheight, b.cursorheight);
                b.cursorwidth = Math.min(b.view.w, Math.round(b.view.w / b.page.w * b.view.w));
                b.cursorwidth = b.opt.cursorfixedheight ? b.opt.cursorfixedheight : Math.max(b.opt.cursorminheight, b.cursorwidth);
                b.scrollvaluemax = b.view.h - b.cursorheight - b.cursor.hborder;
                b.railh &&
                (b.railh.width = 0 < b.page.maxh ? b.view.w - b.rail.width : b.view.w, b.scrollvaluemaxw = b.railh.width - b.cursorwidth - b.cursorh.wborder);
                b.checkrtlmode && b.railh && (b.checkrtlmode = !1, b.opt.rtlmode && 0 == b.scroll.x && b.setScrollLeft(b.page.maxw));
                b.ispage || b.updateScrollBar(b.view);
                b.scrollratio = {x: b.page.maxw / b.scrollvaluemaxw, y: b.page.maxh / b.scrollvaluemax};
                b.getScrollTop() > b.page.maxh ? b.doScrollTop(b.page.maxh) : (b.scroll.y = Math.round(b.getScrollTop() * (1 / b.scrollratio.y)), b.scroll.x = Math.round(b.getScrollLeft() *
                    (1 / b.scrollratio.x)), b.cursoractive && b.noticeCursor());
                b.scroll.y && 0 == b.getScrollTop() && b.doScrollTo(Math.floor(b.scroll.y * b.scrollratio.y));
                return b
            };
            this.resize = b.onResize;
            this.lazyResize = function (c) {
                c = isNaN(c) ? 30 : c;
                b.delayed("resize", b.resize, c);
                return b
            };
            this._bind = function (c, d, e, g) {
                b.events.push({e: c, n: d, f: e, b: g, q: !1});
                c.addEventListener ? c.addEventListener(d, e, g || !1) : c.attachEvent ? c.attachEvent("on" + d, e) : c["on" + d] = e
            };
            this.jqbind = function (c, e, g) {
                b.events.push({e: c, n: e, f: g, q: !0});
                d(c).bind(e, g)
            };
            this.bind = function (c, d, e, g) {
                var q = "jquery" in c ? c[0] : c;
                "mousewheel" == d ? "onwheel" in b.win ? b._bind(q, "wheel", e, g || !1) : (c = "undefined" != typeof document.onmousewheel ? "mousewheel" : "DOMMouseScroll", L(q, c, e, g || !1), "DOMMouseScroll" == c && L(q, "MozMousePixelScroll", e, g || !1)) : q.addEventListener ? (r.cantouch && /mouseup|mousedown|mousemove/.test(d) && b._bind(q, "mousedown" == d ? "touchstart" : "mouseup" == d ? "touchend" : "touchmove", function (b) {
                    if (b.touches) {
                        if (2 > b.touches.length) {
                            var c = b.touches.length ? b.touches[0] : b;
                            c.original =
                                b;
                            e.call(this, c)
                        }
                    } else b.changedTouches && (c = b.changedTouches[0], c.original = b, e.call(this, c))
                }, g || !1), b._bind(q, d, e, g || !1), r.cantouch && "mouseup" == d && b._bind(q, "touchcancel", e, g || !1)) : b._bind(q, d, function (c) {
                    (c = c || window.event || !1) && c.srcElement && (c.target = c.srcElement);
                    "pageY" in c || (c.pageX = c.clientX + document.documentElement.scrollLeft, c.pageY = c.clientY + document.documentElement.scrollTop);
                    return !1 === e.call(q, c) || !1 === g ? b.cancelEvent(c) : !0
                })
            };
            this._unbind = function (b, c, d, e) {
                b.removeEventListener ? b.removeEventListener(c,
                    d, e) : b.detachEvent ? b.detachEvent("on" + c, d) : b["on" + c] = !1
            };
            this.unbindAll = function () {
                for (var c = 0; c < b.events.length; c++) {
                    var d = b.events[c];
                    d.q ? d.e.unbind(d.n, d.f) : b._unbind(d.e, d.n, d.f, d.b)
                }
            };
            this.cancelEvent = function (b) {
                b = b.original ? b.original : b ? b : window.event || !1;
                if (!b)return !1;
                b.preventDefault && b.preventDefault();
                b.stopPropagation && b.stopPropagation();
                b.preventManipulation && b.preventManipulation();
                b.cancelBubble = !0;
                b.cancel = !0;
                return b.returnValue = !1
            };
            this.stopPropagation = function (b) {
                b = b.original ?
                    b.original : b ? b : window.event || !1;
                if (!b)return !1;
                if (b.stopPropagation)return b.stopPropagation();
                b.cancelBubble && (b.cancelBubble = !0);
                return !1
            };
            this.showRail = function () {
                0 == b.page.maxh || !b.ispage && "none" == b.win.css("display") || (b.visibility = !0, b.rail.visibility = !0, b.rail.css("display", "block"));
                return b
            };
            this.showRailHr = function () {
                if (!b.railh)return b;
                0 == b.page.maxw || !b.ispage && "none" == b.win.css("display") || (b.railh.visibility = !0, b.railh.css("display", "block"));
                return b
            };
            this.hideRail = function () {
                b.visibility =
                    !1;
                b.rail.visibility = !1;
                b.rail.css("display", "none");
                return b
            };
            this.hideRailHr = function () {
                if (!b.railh)return b;
                b.railh.visibility = !1;
                b.railh.css("display", "none");
                return b
            };
            this.show = function () {
                b.hidden = !1;
                b.locked = !1;
                return b.showRail().showRailHr()
            };
            this.hide = function () {
                b.hidden = !0;
                b.locked = !0;
                return b.hideRail().hideRailHr()
            };
            this.toggle = function () {
                return b.hidden ? b.show() : b.hide()
            };
            this.remove = function () {
                b.stop();
                b.cursortimeout && clearTimeout(b.cursortimeout);
                b.doZoomOut();
                b.unbindAll();
                !1 !==
                b.observer && b.observer.disconnect();
                !1 !== b.observerremover && b.observerremover.disconnect();
                b.events = [];
                b.cursor && (b.cursor.remove(), b.cursor = null);
                b.cursorh && (b.cursorh.remove(), b.cursorh = null);
                b.rail && (b.rail.remove(), b.rail = null);
                b.railh && (b.railh.remove(), b.railh = null);
                b.zoom && (b.zoom.remove(), b.zoom = null);
                for (var c = 0; c < b.saved.css.length; c++) {
                    var d = b.saved.css[c];
                    d[0].css(d[1], "undefined" == typeof d[2] ? "" : d[2])
                }
                b.saved = !1;
                b.me.data("__nicescroll", "");
                b.me = null;
                b.doc = null;
                b.docscroll = null;
                b.win =
                    null;
                return b
            };
            this.scrollstart = function (c) {
                this.onscrollstart = c;
                return b
            };
            this.scrollend = function (c) {
                this.onscrollend = c;
                return b
            };
            this.scrollcancel = function (c) {
                this.onscrollcancel = c;
                return b
            };
            this.zoomin = function (c) {
                this.onzoomin = c;
                return b
            };
            this.zoomout = function (c) {
                this.onzoomout = c;
                return b
            };
            this.isScrollable = function (b) {
                b = b.target ? b.target : b;
                if ("OPTION" == b.nodeName)return !0;
                for (; b && 1 == b.nodeType && !/BODY|HTML/.test(b.nodeName);) {
                    var c = d(b), c = c.css("overflowY") || c.css("overflowX") || c.css("overflow") ||
                        "";
                    if (/scroll|auto/.test(c))return b.clientHeight != b.scrollHeight;
                    b = b.parentNode ? b.parentNode : !1
                }
                return !1
            };
            this.getViewport = function (b) {
                for (b = b && b.parentNode ? b.parentNode : !1; b && 1 == b.nodeType && !/BODY|HTML/.test(b.nodeName);) {
                    var c = d(b), e = c.css("overflowY") || c.css("overflowX") || c.css("overflow") || "";
                    if (/scroll|auto/.test(e) && b.clientHeight != b.scrollHeight || 0 < c.getNiceScroll().length)return c;
                    b = b.parentNode ? b.parentNode : !1
                }
                return !1
            };
            this.onmousewheel = function (c) {
                if (b.locked)return !0;
                if (b.rail.drag)return b.cancelEvent(c);
                if (!b.rail.scrollable)return b.railh && b.railh.scrollable ? b.onmousewheelhr(c) : !0;
                var d = +new Date, e = !1;
                b.opt.preservenativescrolling && b.checkarea + 600 < d && (b.nativescrollingarea = b.isScrollable(c), e = !0);
                b.checkarea = d;
                if (b.nativescrollingarea)return !0;
                if (c = H(c, !1, e)) b.checkarea = 0;
                return c
            };
            this.onmousewheelhr = function (c) {
                if (b.locked || !b.railh.scrollable)return !0;
                if (b.rail.drag)return b.cancelEvent(c);
                var d = +new Date, e = !1;
                b.opt.preservenativescrolling && b.checkarea + 600 < d && (b.nativescrollingarea = b.isScrollable(c),
                    e = !0);
                b.checkarea = d;
                return b.nativescrollingarea ? !0 : b.locked ? b.cancelEvent(c) : H(c, !0, e)
            };
            this.stop = function () {
                b.cancelScroll();
                b.scrollmon && b.scrollmon.stop();
                b.cursorfreezed = !1;
                b.scroll.y = Math.round(b.getScrollTop() * (1 / b.scrollratio.y));
                b.noticeCursor();
                return b
            };
            this.getTransitionSpeed = function (c) {
                var d = Math.round(10 * b.opt.scrollspeed);
                c = Math.min(d, Math.round(c / 20 * b.opt.scrollspeed));
                return 20 < c ? c : 0
            };
            b.opt.smoothscroll ? b.ishwscroll && r.hastransition && b.opt.usetransition ? (this.prepareTransition = function (c,
                                                                                                                              d) {
                var e = d ? 20 < c ? c : 0 : b.getTransitionSpeed(c),
                    g = e ? r.prefixstyle + "transform " + e + "ms ease-out" : "";
                b.lasttransitionstyle && b.lasttransitionstyle == g || (b.lasttransitionstyle = g, b.doc.css(r.transitionstyle, g));
                return e
            }, this.doScrollLeft = function (c, d) {
                var e = b.scrollrunning ? b.newscrolly : b.getScrollTop();
                b.doScrollPos(c, e, d)
            }, this.doScrollTop = function (c, d) {
                var e = b.scrollrunning ? b.newscrollx : b.getScrollLeft();
                b.doScrollPos(e, c, d)
            }, this.doScrollPos = function (c, d, e) {
                var g = b.getScrollTop(), q = b.getScrollLeft();
                (0 >
                (b.newscrolly - g) * (d - g) || 0 > (b.newscrollx - q) * (c - q)) && b.cancelScroll();
                0 == b.opt.bouncescroll && (0 > d ? d = 0 : d > b.page.maxh && (d = b.page.maxh), 0 > c ? c = 0 : c > b.page.maxw && (c = b.page.maxw));
                if (b.scrollrunning && c == b.newscrollx && d == b.newscrolly)return !1;
                b.newscrolly = d;
                b.newscrollx = c;
                b.newscrollspeed = e || !1;
                if (b.timer)return !1;
                b.timer = setTimeout(function () {
                    var e = b.getScrollTop(), g = b.getScrollLeft(), q, k;
                    q = c - g;
                    k = d - e;
                    q = Math.round(Math.sqrt(Math.pow(q, 2) + Math.pow(k, 2)));
                    q = b.newscrollspeed && 1 < b.newscrollspeed ? b.newscrollspeed :
                        b.getTransitionSpeed(q);
                    b.newscrollspeed && 1 >= b.newscrollspeed && (q *= b.newscrollspeed);
                    b.prepareTransition(q, !0);
                    b.timerscroll && b.timerscroll.tm && clearInterval(b.timerscroll.tm);
                    0 < q && (!b.scrollrunning && b.onscrollstart && b.onscrollstart.call(b, {
                        type: "scrollstart",
                        current: {x: g, y: e},
                        request: {x: c, y: d},
                        end: {x: b.newscrollx, y: b.newscrolly},
                        speed: q
                    }), r.transitionend ? b.scrollendtrapped || (b.scrollendtrapped = !0, b.bind(b.doc, r.transitionend, b.onScrollEnd, !1)) : (b.scrollendtrapped && clearTimeout(b.scrollendtrapped),
                        b.scrollendtrapped = setTimeout(b.onScrollEnd, q)), b.timerscroll = {
                        bz: new BezierClass(e, b.newscrolly, q, 0, 0, .58, 1),
                        bh: new BezierClass(g, b.newscrollx, q, 0, 0, .58, 1)
                    }, b.cursorfreezed || (b.timerscroll.tm = setInterval(function () {
                        b.showCursor(b.getScrollTop(), b.getScrollLeft())
                    }, 60)));
                    b.synched("doScroll-set", function () {
                        b.timer = 0;
                        b.scrollendtrapped && (b.scrollrunning = !0);
                        b.setScrollTop(b.newscrolly);
                        b.setScrollLeft(b.newscrollx);
                        if (!b.scrollendtrapped) b.onScrollEnd()
                    })
                }, 50)
            }, this.cancelScroll = function () {
                if (!b.scrollendtrapped)return !0;
                var c = b.getScrollTop(), d = b.getScrollLeft();
                b.scrollrunning = !1;
                r.transitionend || clearTimeout(r.transitionend);
                b.scrollendtrapped = !1;
                b._unbind(b.doc, r.transitionend, b.onScrollEnd);
                b.prepareTransition(0);
                b.setScrollTop(c);
                b.railh && b.setScrollLeft(d);
                b.timerscroll && b.timerscroll.tm && clearInterval(b.timerscroll.tm);
                b.timerscroll = !1;
                b.cursorfreezed = !1;
                b.showCursor(c, d);
                return b
            }, this.onScrollEnd = function () {
                b.scrollendtrapped && b._unbind(b.doc, r.transitionend, b.onScrollEnd);
                b.scrollendtrapped = !1;
                b.prepareTransition(0);
                b.timerscroll && b.timerscroll.tm && clearInterval(b.timerscroll.tm);
                b.timerscroll = !1;
                var c = b.getScrollTop(), d = b.getScrollLeft();
                b.setScrollTop(c);
                b.railh && b.setScrollLeft(d);
                b.noticeCursor(!1, c, d);
                b.cursorfreezed = !1;
                0 > c ? c = 0 : c > b.page.maxh && (c = b.page.maxh);
                0 > d ? d = 0 : d > b.page.maxw && (d = b.page.maxw);
                if (c != b.newscrolly || d != b.newscrollx)return b.doScrollPos(d, c, b.opt.snapbackspeed);
                b.onscrollend && b.scrollrunning && b.onscrollend.call(b, {
                    type: "scrollend",
                    current: {x: d, y: c},
                    end: {x: b.newscrollx, y: b.newscrolly}
                });
                b.scrollrunning =
                    !1
            }) : (this.doScrollLeft = function (c, d) {
                var e = b.scrollrunning ? b.newscrolly : b.getScrollTop();
                b.doScrollPos(c, e, d)
            }, this.doScrollTop = function (c, d) {
                var e = b.scrollrunning ? b.newscrollx : b.getScrollLeft();
                b.doScrollPos(e, c, d)
            }, this.doScrollPos = function (c, d, e) {
                function g() {
                    if (b.cancelAnimationFrame)return !0;
                    b.scrollrunning = !0;
                    if (B = 1 - B)return b.timer = x(g) || 1;
                    var c = 0, d = sy = b.getScrollTop();
                    if (b.dst.ay) {
                        var d = b.bzscroll ? b.dst.py + b.bzscroll.getNow() * b.dst.ay : b.newscrolly, e = d - sy;
                        if (0 > e && d < b.newscrolly || 0 < e && d > b.newscrolly) d =
                            b.newscrolly;
                        b.setScrollTop(d);
                        d == b.newscrolly && (c = 1)
                    } else c = 1;
                    var q = sx = b.getScrollLeft();
                    if (b.dst.ax) {
                        q = b.bzscroll ? b.dst.px + b.bzscroll.getNow() * b.dst.ax : b.newscrollx;
                        e = q - sx;
                        if (0 > e && q < b.newscrollx || 0 < e && q > b.newscrollx) q = b.newscrollx;
                        b.setScrollLeft(q);
                        q == b.newscrollx && (c += 1)
                    } else c += 1;
                    2 == c ? (b.timer = 0, b.cursorfreezed = !1, b.bzscroll = !1, b.scrollrunning = !1, 0 > d ? d = 0 : d > b.page.maxh && (d = b.page.maxh), 0 > q ? q = 0 : q > b.page.maxw && (q = b.page.maxw), q != b.newscrollx || d != b.newscrolly ? b.doScrollPos(q, d) : b.onscrollend && b.onscrollend.call(b,
                            {
                                type: "scrollend",
                                current: {x: sx, y: sy},
                                end: {x: b.newscrollx, y: b.newscrolly}
                            })) : b.timer = x(g) || 1
                }

                d = "undefined" == typeof d || !1 === d ? b.getScrollTop(!0) : d;
                if (b.timer && b.newscrolly == d && b.newscrollx == c)return !0;
                b.timer && s(b.timer);
                b.timer = 0;
                var q = b.getScrollTop(), k = b.getScrollLeft();
                (0 > (b.newscrolly - q) * (d - q) || 0 > (b.newscrollx - k) * (c - k)) && b.cancelScroll();
                b.newscrolly = d;
                b.newscrollx = c;
                b.bouncescroll && b.rail.visibility || (0 > b.newscrolly ? b.newscrolly = 0 : b.newscrolly > b.page.maxh && (b.newscrolly = b.page.maxh));
                b.bouncescroll &&
                b.railh.visibility || (0 > b.newscrollx ? b.newscrollx = 0 : b.newscrollx > b.page.maxw && (b.newscrollx = b.page.maxw));
                b.dst = {};
                b.dst.x = c - k;
                b.dst.y = d - q;
                b.dst.px = k;
                b.dst.py = q;
                var n = Math.round(Math.sqrt(Math.pow(b.dst.x, 2) + Math.pow(b.dst.y, 2)));
                b.dst.ax = b.dst.x / n;
                b.dst.ay = b.dst.y / n;
                var r = 0, w = n;
                0 == b.dst.x ? (r = q, w = d, b.dst.ay = 1, b.dst.py = 0) : 0 == b.dst.y && (r = k, w = c, b.dst.ax = 1, b.dst.px = 0);
                n = b.getTransitionSpeed(n);
                e && 1 >= e && (n *= e);
                b.bzscroll = 0 < n ? b.bzscroll ? b.bzscroll.update(w, n) : new BezierClass(r, w, n, 0, 1, 0, 1) : !1;
                if (!b.timer) {
                    (q ==
                    b.page.maxh && d >= b.page.maxh || k == b.page.maxw && c >= b.page.maxw) && b.checkContentSize();
                    var B = 1;
                    b.cancelAnimationFrame = !1;
                    b.timer = 1;
                    b.onscrollstart && !b.scrollrunning && b.onscrollstart.call(b, {
                        type: "scrollstart",
                        current: {x: k, y: q},
                        request: {x: c, y: d},
                        end: {x: b.newscrollx, y: b.newscrolly},
                        speed: n
                    });
                    g();
                    (q == b.page.maxh && d >= q || k == b.page.maxw && c >= k) && b.checkContentSize();
                    b.noticeCursor()
                }
            }, this.cancelScroll = function () {
                b.timer && s(b.timer);
                b.timer = 0;
                b.bzscroll = !1;
                b.scrollrunning = !1;
                return b
            }) : (this.doScrollLeft = function (c,
                                                d) {
                var e = b.getScrollTop();
                b.doScrollPos(c, e, d)
            }, this.doScrollTop = function (c, d) {
                var e = b.getScrollLeft();
                b.doScrollPos(e, c, d)
            }, this.doScrollPos = function (c, d, e) {
                var g = c > b.page.maxw ? b.page.maxw : c;
                0 > g && (g = 0);
                var q = d > b.page.maxh ? b.page.maxh : d;
                0 > q && (q = 0);
                b.synched("scroll", function () {
                    b.setScrollTop(q);
                    b.setScrollLeft(g)
                })
            }, this.cancelScroll = function () {
            });
            this.doScrollBy = function (c, d) {
                var e = 0,
                    e = d ? Math.floor((b.scroll.y - c) * b.scrollratio.y) : (b.timer ? b.newscrolly : b.getScrollTop(!0)) - c;
                if (b.bouncescroll) {
                    var g =
                        Math.round(b.view.h / 2);
                    e < -g ? e = -g : e > b.page.maxh + g && (e = b.page.maxh + g)
                }
                b.cursorfreezed = !1;
                py = b.getScrollTop(!0);
                if (0 > e && 0 >= py)return b.noticeCursor();
                if (e > b.page.maxh && py >= b.page.maxh)return b.checkContentSize(), b.noticeCursor();
                b.doScrollTop(e)
            };
            this.doScrollLeftBy = function (c, d) {
                var e = 0,
                    e = d ? Math.floor((b.scroll.x - c) * b.scrollratio.x) : (b.timer ? b.newscrollx : b.getScrollLeft(!0)) - c;
                if (b.bouncescroll) {
                    var g = Math.round(b.view.w / 2);
                    e < -g ? e = -g : e > b.page.maxw + g && (e = b.page.maxw + g)
                }
                b.cursorfreezed = !1;
                px = b.getScrollLeft(!0);
                if (0 > e && 0 >= px || e > b.page.maxw && px >= b.page.maxw)return b.noticeCursor();
                b.doScrollLeft(e)
            };
            this.doScrollTo = function (c, d) {
                d && Math.round(c * b.scrollratio.y);
                b.cursorfreezed = !1;
                b.doScrollTop(c)
            };
            this.checkContentSize = function () {
                var c = b.getContentSize();
                c.h == b.page.h && c.w == b.page.w || b.resize(!1, c)
            };
            b.onscroll = function (c) {
                b.rail.drag || b.cursorfreezed || b.synched("scroll", function () {
                    b.scroll.y = Math.round(b.getScrollTop() * (1 / b.scrollratio.y));
                    b.railh && (b.scroll.x = Math.round(b.getScrollLeft() * (1 / b.scrollratio.x)));
                    b.noticeCursor()
                })
            };
            b.bind(b.docscroll, "scroll", b.onscroll);
            this.doZoomIn = function (c) {
                if (!b.zoomactive) {
                    b.zoomactive = !0;
                    b.zoomrestore = {style: {}};
                    var e = "position top left zIndex backgroundColor marginTop marginBottom marginLeft marginRight".split(" "),
                        q = b.win[0].style, k;
                    for (k in e) {
                        var n = e[k];
                        b.zoomrestore.style[n] = "undefined" != typeof q[n] ? q[n] : ""
                    }
                    b.zoomrestore.style.width = b.win.css("width");
                    b.zoomrestore.style.height = b.win.css("height");
                    b.zoomrestore.padding = {
                        w: b.win.outerWidth() - b.win.width(), h: b.win.outerHeight() -
                        b.win.height()
                    };
                    r.isios4 && (b.zoomrestore.scrollTop = d(window).scrollTop(), d(window).scrollTop(0));
                    b.win.css({
                        position: r.isios4 ? "absolute" : "fixed",
                        top: 0,
                        left: 0,
                        "z-index": g + 100,
                        margin: "0px"
                    });
                    e = b.win.css("backgroundColor");
                    ("" == e || /transparent|rgba\(0, 0, 0, 0\)|rgba\(0,0,0,0\)/.test(e)) && b.win.css("backgroundColor", "#fff");
                    b.rail.css({"z-index": g + 101});
                    b.zoom.css({"z-index": g + 102});
                    b.zoom.css("backgroundPosition", "0px -18px");
                    b.resizeZoom();
                    b.onzoomin && b.onzoomin.call(b);
                    return b.cancelEvent(c)
                }
            };
            this.doZoomOut =
                function (c) {
                    if (b.zoomactive)return b.zoomactive = !1, b.win.css("margin", ""), b.win.css(b.zoomrestore.style), r.isios4 && d(window).scrollTop(b.zoomrestore.scrollTop), b.rail.css({"z-index": b.zindex}), b.zoom.css({"z-index": b.zindex}), b.zoomrestore = !1, b.zoom.css("backgroundPosition", "0px 0px"), b.onResize(), b.onzoomout && b.onzoomout.call(b), b.cancelEvent(c)
                };
            this.doZoom = function (c) {
                return b.zoomactive ? b.doZoomOut(c) : b.doZoomIn(c)
            };
            this.resizeZoom = function () {
                if (b.zoomactive) {
                    var c = b.getScrollTop();
                    b.win.css({
                        width: d(window).width() -
                        b.zoomrestore.padding.w + "px", height: d(window).height() - b.zoomrestore.padding.h + "px"
                    });
                    b.onResize();
                    b.setScrollTop(Math.min(b.page.maxh, c))
                }
            };
            this.init();
            d.nicescroll.push(this)
        }, ea = function (c) {
            var d = this;
            this.nc = c;
            this.steptime = this.lasttime = this.speedy = this.speedx = this.lasty = this.lastx = 0;
            this.snapy = this.snapx = !1;
            this.demuly = this.demulx = 0;
            this.lastscrolly = this.lastscrollx = -1;
            this.timer = this.chky = this.chkx = 0;
            this.time = function () {
                return +new Date
            };
            this.reset = function (c, e) {
                d.stop();
                var g = d.time();
                d.steptime =
                    0;
                d.lasttime = g;
                d.speedx = 0;
                d.speedy = 0;
                d.lastx = c;
                d.lasty = e;
                d.lastscrollx = -1;
                d.lastscrolly = -1
            };
            this.update = function (c, e) {
                var g = d.time();
                d.steptime = g - d.lasttime;
                d.lasttime = g;
                var g = e - d.lasty, k = c - d.lastx, b = d.nc.getScrollTop(), n = d.nc.getScrollLeft(), b = b + g,
                    n = n + k;
                d.snapx = 0 > n || n > d.nc.page.maxw;
                d.snapy = 0 > b || b > d.nc.page.maxh;
                d.speedx = k;
                d.speedy = g;
                d.lastx = c;
                d.lasty = e
            };
            this.stop = function () {
                d.nc.unsynched("domomentum2d");
                d.timer && clearTimeout(d.timer);
                d.timer = 0;
                d.lastscrollx = -1;
                d.lastscrolly = -1
            };
            this.doSnapy = function (c,
                                     e) {
                var g = !1;
                0 > e ? (e = 0, g = !0) : e > d.nc.page.maxh && (e = d.nc.page.maxh, g = !0);
                0 > c ? (c = 0, g = !0) : c > d.nc.page.maxw && (c = d.nc.page.maxw, g = !0);
                g && d.nc.doScrollPos(c, e, d.nc.opt.snapbackspeed)
            };
            this.doMomentum = function (c) {
                var e = d.time(), g = c ? e + c : d.lasttime;
                c = d.nc.getScrollLeft();
                var k = d.nc.getScrollTop(), b = d.nc.page.maxh, n = d.nc.page.maxw;
                d.speedx = 0 < n ? Math.min(60, d.speedx) : 0;
                d.speedy = 0 < b ? Math.min(60, d.speedy) : 0;
                g = g && 50 >= e - g;
                if (0 > k || k > b || 0 > c || c > n) g = !1;
                c = d.speedx && g ? d.speedx : !1;
                if (d.speedy && g && d.speedy || c) {
                    var r = Math.max(16,
                        d.steptime);
                    50 < r && (c = r / 50, d.speedx *= c, d.speedy *= c, r = 50);
                    d.demulxy = 0;
                    d.lastscrollx = d.nc.getScrollLeft();
                    d.chkx = d.lastscrollx;
                    d.lastscrolly = d.nc.getScrollTop();
                    d.chky = d.lastscrolly;
                    var w = d.lastscrollx, B = d.lastscrolly, l = function () {
                        var c = 600 < d.time() - e ? .04 : .02;
                        d.speedx && (w = Math.floor(d.lastscrollx - d.speedx * (1 - d.demulxy)), d.lastscrollx = w, 0 > w || w > n) && (c = .1);
                        d.speedy && (B = Math.floor(d.lastscrolly - d.speedy * (1 - d.demulxy)), d.lastscrolly = B, 0 > B || B > b) && (c = .1);
                        d.demulxy = Math.min(1, d.demulxy + c);
                        d.nc.synched("domomentum2d",
                            function () {
                                d.speedx && (d.nc.getScrollLeft() != d.chkx && d.stop(), d.chkx = w, d.nc.setScrollLeft(w));
                                d.speedy && (d.nc.getScrollTop() != d.chky && d.stop(), d.chky = B, d.nc.setScrollTop(B));
                                d.timer || (d.nc.hideCursor(), d.doSnapy(w, B))
                            });
                        1 > d.demulxy ? d.timer = setTimeout(l, r) : (d.stop(), d.nc.hideCursor(), d.doSnapy(w, B))
                    };
                    l()
                } else d.doSnapy(d.nc.getScrollLeft(), d.nc.getScrollTop())
            }
        }, ca = d.fn.scrollTop;
    d.cssHooks.pageYOffset = {
        get: function (c, e, g) {
            return (e = d.data(c, "__nicescroll") || !1) && e.ishwscroll ? e.getScrollTop() : ca.call(c)
        },
        set: function (c, e) {
            var g = d.data(c, "__nicescroll") || !1;
            g && g.ishwscroll ? g.setScrollTop(parseInt(e)) : ca.call(c, e);
            return this
        }
    };
    d.fn.scrollTop = function (c) {
        if ("undefined" == typeof c) {
            var e = this[0] ? d.data(this[0], "__nicescroll") || !1 : !1;
            return e && e.ishwscroll ? e.getScrollTop() : ca.call(this)
        }
        return this.each(function () {
            var e = d.data(this, "__nicescroll") || !1;
            e && e.ishwscroll ? e.setScrollTop(parseInt(c)) : ca.call(d(this), c)
        })
    };
    var w = d.fn.scrollLeft;
    d.cssHooks.pageXOffset = {
        get: function (c, e, g) {
            return (e = d.data(c, "__nicescroll") ||
                !1) && e.ishwscroll ? e.getScrollLeft() : w.call(c)
        }, set: function (c, e) {
            var g = d.data(c, "__nicescroll") || !1;
            g && g.ishwscroll ? g.setScrollLeft(parseInt(e)) : w.call(c, e);
            return this
        }
    };
    d.fn.scrollLeft = function (c) {
        if ("undefined" == typeof c) {
            var e = this[0] ? d.data(this[0], "__nicescroll") || !1 : !1;
            return e && e.ishwscroll ? e.getScrollLeft() : w.call(this)
        }
        return this.each(function () {
            var e = d.data(this, "__nicescroll") || !1;
            e && e.ishwscroll ? e.setScrollLeft(parseInt(c)) : w.call(d(this), c)
        })
    };
    var F = function (c) {
        var e = this;
        this.length =
            0;
        this.name = "nicescrollarray";
        this.each = function (c) {
            for (var d = 0; d < e.length; d++)c.call(e[d]);
            return e
        };
        this.push = function (c) {
            e[e.length] = c;
            e.length++
        };
        this.eq = function (c) {
            return e[c]
        };
        if (c)for (a = 0; a < c.length; a++) {
            var g = d.data(c[a], "__nicescroll") || !1;
            g && (this[this.length] = g, this.length++)
        }
        return this
    };
    (function (c, d, e) {
        for (var g = 0; g < d.length; g++)e(c, d[g])
    })(F.prototype, "show hide toggle onResize resize remove stop doScrollPos".split(" "), function (c, d) {
        c[d] = function () {
            var c = arguments;
            return this.each(function () {
                this[d].apply(this,
                    c)
            })
        }
    });
    d.fn.getNiceScroll = function (c) {
        return "undefined" == typeof c ? new F(this) : d.data(this[c], "__nicescroll") || !1
    };
    d.extend(d.expr[":"], {
        nicescroll: function (c) {
            return d.data(c, "__nicescroll") ? !0 : !1
        }
    });
    d.fn.niceScroll = function (c, e) {
        "undefined" == typeof e && "object" == typeof c && !("jquery" in c) && (e = c, c = !1);
        var g = new F;
        "undefined" == typeof e && (e = {});
        c && (e.doc = d(c), e.win = d(this));
        var k = !("doc" in e);
        k || "win" in e || (e.win = d(this));
        this.each(function () {
            var c = d(this).data("__nicescroll") || !1;
            c || (e.doc = k ? d(this) :
                e.doc, c = new T(e, d(this)), d(this).data("__nicescroll", c));
            g.push(c)
        });
        return 1 == g.length ? g[0] : g
    };
    window.NiceScroll = {
        getjQuery: function () {
            return d
        }
    };
    d.nicescroll || (d.nicescroll = new F, d.nicescroll.options = C)
})(jQuery);
!function (d, n) {
    "function" == typeof define && define.amd ? define(["jquery"], n) : "object" == typeof exports ? module.exports = n(require("jquery")) : d.bootbox = n(d.jQuery)
}(this, function t$$1(n, t) {
    function c(c, e, g) {
        c.stopPropagation();
        c.preventDefault();
        n.isFunction(g) && !1 === g(c) || e.modal("hide")
    }

    function e(c) {
        var e, g = 0;
        for (e in c)g++;
        return g
    }

    function g(c, e) {
        var g = 0;
        n.each(c, function (c, k) {
            e(c, k, g++)
        })
    }

    function k(c) {
        var k, s;
        if ("object" != typeof c)throw Error("Please supply an object of options");
        if (!c.message)throw Error("Please specify a message");
        return c = n.extend({}, T, c), c.buttons || (c.buttons = {}), c.backdrop = c.backdrop ? "static" : !1, k = c.buttons, s = e(k), g(k, function (c, e, g) {
            if (n.isFunction(e) && (e = k[c] = {callback: e}), "object" !== n.type(e))throw Error("button with key " + c + " must be an object");
            e.label || (e.label = c);
            e.className || (e.className = 2 >= s && g === s - 1 ? "btn-primary" : "btn-default")
        }), c
    }

    function x(c, e) {
        var g = c.length, k = {};
        if (1 > g || 2 < g)throw Error("Invalid argument length");
        return 2 === g || "string" == typeof c[0] ? (k[e[0]] = c[0], k[e[1]] = c[1]) : k = c[0], k
    }

    function s(c,
               e, g) {
        return n.extend(!0, {}, c, x(e, g))
    }

    function G(c, e, g, k) {
        c = {className: "bootbox-" + c, buttons: C.apply(null, e)};
        return H(s(c, k, g), e)
    }

    function C() {
        for (var c = {}, e = 0, g = arguments.length; g > e; e++) {
            var k = arguments[e], n = k.toLowerCase(), k = k.toUpperCase(), s = ca[T.locale];
            c[n] = {label: s ? s[k] : ca.en[k]}
        }
        return c
    }

    function H(c, e) {
        var k = {};
        return g(e, function (c, e) {
            k[e] = !0
        }), g(c.buttons, function (c) {
            if (k[c] === t)throw Error("button key " + c + " is not allowed (options are " + e.join("\n") + ")");
        }), c
    }

    var P = {
            text: "<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",
            textarea: "<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",
            email: "<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",
            select: "<select class='bootbox-input bootbox-input-select form-control'></select>",
            checkbox: "<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",
            date: "<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",
            time: "<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",
            number: "<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",
            password: "<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"
        }, T = {locale: "en", backdrop: !0, animate: !0, className: null, closeButton: !0, show: !0, container: "body"},
        ea = {
            alert: function () {
                var c;
                if (c = G("alert", ["ok"], ["message", "callback"], arguments), c.callback &&
                    !n.isFunction(c.callback))throw Error("alert requires callback property to be a function when provided");
                return c.buttons.ok.callback = c.onEscape = function () {
                    return n.isFunction(c.callback) ? c.callback() : !0
                }, ea.dialog(c)
            }, confirm: function () {
                var c;
                if (c = G("confirm", ["cancel", "confirm"], ["message", "callback"], arguments), c.buttons.cancel.callback = c.onEscape = function () {
                        return c.callback(!1)
                    }, c.buttons.confirm.callback = function () {
                        return c.callback(!0)
                    }, !n.isFunction(c.callback))throw Error("confirm requires a callback");
                return ea.dialog(c)
            }, prompt: function () {
                var c, e, k, q, x, G, L;
                if (q = n("<form class='bootbox-form'></form>"), e = {
                        className: "bootbox-prompt",
                        buttons: C("cancel", "confirm"),
                        value: "",
                        inputType: "text"
                    }, c = H(s(e, arguments, ["title", "callback"]), ["cancel", "confirm"]), G = c.show === t ? !0 : c.show, c.message = q, c.buttons.cancel.callback = c.onEscape = function () {
                        return c.callback(null)
                    }, c.buttons.confirm.callback = function () {
                        var b;
                        switch (c.inputType) {
                            case "text":
                            case "textarea":
                            case "email":
                            case "select":
                            case "date":
                            case "time":
                            case "number":
                            case "password":
                                b =
                                    x.val();
                                break;
                            case "checkbox":
                                var e = x.find("input:checked");
                                b = [];
                                g(e, function (c, e) {
                                    b.push(n(e).val())
                                })
                        }
                        return c.callback(b)
                    }, c.show = !1, !c.title)throw Error("prompt requires a title");
                if (!n.isFunction(c.callback))throw Error("prompt requires a callback");
                if (!P[c.inputType])throw Error("invalid prompt type");
                switch (x = n(P[c.inputType]), c.inputType) {
                    case "text":
                    case "textarea":
                    case "email":
                    case "date":
                    case "time":
                    case "number":
                    case "password":
                        x.val(c.value);
                        break;
                    case "select":
                        var T = {};
                        if (L = c.inputOptions ||
                                [], !L.length)throw Error("prompt with select requires options");
                        g(L, function (b, c) {
                            var e = x;
                            if (c.value === t || c.text === t)throw Error("given options in wrong format");
                            c.group && (T[c.group] || (T[c.group] = n("<optgroup/>").attr("label", c.group)), e = T[c.group]);
                            e.append("<option value='" + c.value + "'>" + c.text + "</option>")
                        });
                        g(T, function (b, c) {
                            x.append(c)
                        });
                        x.val(c.value);
                        break;
                    case "checkbox":
                        var b = n.isArray(c.value) ? c.value : [c.value];
                        if (L = c.inputOptions || [], !L.length)throw Error("prompt with checkbox requires options");
                        if (!L[0].value || !L[0].text)throw Error("given options in wrong format");
                        x = n("<div/>");
                        g(L, function (e, k) {
                            var q = n(P[c.inputType]);
                            q.find("input").attr("value", k.value);
                            q.find("label").append(k.text);
                            g(b, function (b, c) {
                                c === k.value && q.find("input").prop("checked", !0)
                            });
                            x.append(q)
                        })
                }
                return c.placeholder && x.attr("placeholder", c.placeholder), c.pattern && x.attr("pattern", c.pattern), q.append(x), q.on("submit", function (b) {
                    b.preventDefault();
                    b.stopPropagation();
                    k.find(".btn-primary").click()
                }), k = ea.dialog(c),
                    k.off("shown.bs.modal"), k.on("shown.bs.modal", function () {
                    x.focus()
                }), !0 === G && k.modal("show"), k
            }, dialog: function (e) {
                e = k(e);
                var s = n("<div class='bootbox modal' tabindex='-1' role='dialog'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='bootbox-body'></div></div></div></div></div>"),
                    t = s.find(".modal-dialog"), q = s.find(".modal-body"), x = "", C = {onEscape: e.onEscape};
                if (g(e.buttons, function (c, e) {
                        x += "<button data-bb-handler='" + c + "' type='button' class='btn " + e.className +
                            "'>" + e.label + "</button>";
                        C[c] = e.callback
                    }), q.find(".bootbox-body").html(e.message), !0 === e.animate && s.addClass("fade"), e.className && s.addClass(e.className), "large" === e.size && t.addClass("modal-lg"), "small" === e.size && t.addClass("modal-sm"), e.title && (q.before("<div class='modal-header'><h4 class='modal-title'></h4></div>"), e.title_className && s.find(".modal-header").addClass(e.title_className)), e.closeButton) t = n("<button type='button' class='bootbox-close-button close' data-dismiss='modal' aria-hidden='true'>&times;</button>"),
                    e.title ? s.find(".modal-header").prepend(t) : t.css("margin-top", "-10px").prependTo(q);
                return e.title && s.find(".modal-title").html(e.title), x.length && (q.after("<div class='modal-footer'></div>"), s.find(".modal-footer").html(x)), s.on("hidden.bs.modal", function (c) {
                    c.target === this && s.remove()
                }), s.on("shown.bs.modal", function () {
                    s.find(".btn-primary:first").focus()
                }), s.on("escape.close.bb", function (e) {
                    C.onEscape && c(e, s, C.onEscape)
                }), s.on("click", ".modal-footer button", function (e) {
                    var g = n(this).data("bb-handler");
                    c(e, s, C[g])
                }), s.on("click", ".bootbox-close-button", function (e) {
                    c(e, s, C.onEscape)
                }), s.on("keyup", function (c) {
                    27 === c.which && s.trigger("escape.close.bb")
                }), n(e.container).append(s), s.modal({
                    backdrop: e.backdrop,
                    keyboard: !1,
                    show: !1
                }), e.show && s.modal("show"), s
            }, setDefaults: function () {
                var c = {};
                2 === arguments.length ? c[arguments[0]] = arguments[1] : c = arguments[0];
                n.extend(T, c)
            }, hideAll: function () {
                return n(".bootbox").modal("hide"), ea
            }
        }, ca = {en: {OK: "OK", CANCEL: "Cancel", CONFIRM: "OK"}};
    return ea.init = function (c) {
        return t$$1(c ||
            n)
    }, ea
});

$(document).ready(function () {
    myDropdown();
    //toolTips();
    var d = $("#sidebar"),
        n = d.find("ul li div"),
        t;
    n.on("click", function () {
        t = $(this);
        0 == t.hasClass("active") ? (n.removeClass("active"), t.addClass("active"), t.siblings("ul").stop().slideDown(300, function () {
            t.find(".icon-angle-right").removeClass("icon-angle-right").addClass("icon-angle-down");
            d.children("ul").getNiceScroll().resize()
        })) : (t.removeClass("active"), t.siblings("ul").slideUp(300, function () {
            t.find(".icon-angle-down").removeClass("icon-angle-down").addClass("icon-angle-right");
            d.children("ul").getNiceScroll().resize()
        }))
    });
    var c = d.find(".sidebar-toggle"),
        e = $("#main-page");
    c.on("click", function () {
        d.data("flag") ? (d.css("left", 0), e.removeClass("expand"), c.removeClass("closed").find(".icon-right-open").addClass("icon-left-open").removeClass("icon-right-open"), d.data("flag", !1), d.children("ul").getNiceScroll().show()) : (d.css("left", -210), d.data("flag", !0), e.addClass("expand"), c.addClass("closed").find(".icon-left-open").removeClass("icon-left-open").addClass("icon-right-open"), d.children("ul").getNiceScroll().hide());
        if (0 <
            $("#chart_line_container").length) {
            var g = [$("#select-chart-by-1").val(), $("#select-chart-by-2").val()];
            highcharts.render($("#chart_line_container"), g)
        }
    });
    var g = $(window);
    setStatusSideBar(g, e, d);
    tabResponsive(g);
    g.resize(function () {
        setStatusSideBar(g, e, d);
        tabResponsive(g)
    });
    var k = $(window).height();
    d.children("ul").niceScroll({
        cursorborder: "",
        cursorcolor: "#ccc",
        cursorwidth: "5px",
        autohidemode: !1
    });
    $("#main-page #scroll_page").height(k - 80);
    $("#scroll_page").niceScroll({
        cursorborder: "",
        cursorcolor: "#ccc",
        cursorwidth: "10px",
        autohidemode: !1
    })
});

function myDropdown() {
    $(".my-dropdown").on("click", function () {
        if ($(this).hasClass('on-hover') == true) {
            return false;
        }
        $(this).data("flag") ? ($(this).parent(".dropdown").removeClass("open"), $(this).data("flag", !1)) : ($(this).parent(".dropdown").addClass("open"), $(this).data("flag", !0))
    }).hover(function () {
        $(this).addClass('on-hover');
    }, function () {
        $(this).removeClass('on-hover');
    }).find('a.select-domain').each(function () {
        $(this).click(function () {
            var self = this;
            var dg = $(self).attr('data-domain-group'), el = $('#domains-' + dg);
            if ($(el).hasClass('hide')) {
                $(el).removeClass('hide')
                    .addClass('show');
            } else {
                $(el).removeClass('show')
                    .addClass('hide');
            }
        });
    });

    $('.user-action').hover(function () {
        $(".my-dropdown").removeClass('on-hover');
    }, function () {
        $(".my-dropdown").addClass('on-hover');
    });
}

function toolTips() {
    $(".tooltips").tooltip()
}

function listCollapse() {
    $(".list-collapse").find("li").children("label").on("click", function () {
        var d = $(this).parent();
        d.hasClass("expand") ? d.removeClass("expand").addClass("collapse") : d.hasClass("collapse") && d.removeClass("collapse").addClass("expand")
    })
}

function tabResponsive(d) {
    var n = $("#main-page").find(".tab-responsive").find(".panel");
    767 >= d.width() ? (n.removeClass("tab-pane"), n.find(".panel-collapse").addClass("collapse")) : (n.addClass("tab-pane"), n.find(".panel-collapse").removeClass("collapse"))
}

function setStatusSideBar(d, n, t) {
    d = d.width();
    var c = $("#main-page").find(".table").width(),
        e = $("#main-page").width(),
        g = t.height() - 20;
    t.children("ul").height(g);
    if (767 >= d || c > e) t.css("left", -210), n.addClass("expand"), t.find(".sidebar-toggle").addClass("closed").find(".icon-left-open").removeClass("icon-left-open").addClass("icon-right-open"), $(".sidebar-toggle").tooltip("show"), t.data("flag", !0)
};
