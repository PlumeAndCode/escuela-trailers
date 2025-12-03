import React, { useEffect } from "react";
import { View, Text, ScrollView, RefreshControl } from "react-native";
import { Ionicons } from "@expo/vector-icons";
import { useAuthStore } from "../../src/stores/authStore";
import { useDashboardStore } from "../../src/stores/dashboardStore";
import { Card } from "../../src/components/ui/Card";
import { Badge } from "../../src/components/ui/Badge";
import { Loading } from "../../src/components/ui/Loading";

export default function DashboardScreen() {
    const { user } = useAuthStore();
    const { stats, proximosPagos, isLoading, fetchDashboard, refresh } = useDashboardStore();

    useEffect(() => {
        fetchDashboard();
    }, []);

    if (isLoading && !stats) {
        return <Loading fullScreen message="Cargando dashboard..." />;
    }

    return (
        <ScrollView
            className="flex-1 bg-slate-100"
            refreshControl={<RefreshControl refreshing={isLoading} onRefresh={refresh} />}
        >
            {/* Header */}
            <View className="bg-slate-800 px-6 pt-14 pb-8 rounded-b-3xl">
                <Text className="text-slate-400">Bienvenido,</Text>
                <Text className="text-2xl font-bold text-white mt-1">{user?.nombre_completo}</Text>
            </View>

            <View className="px-4 -mt-4">
                {/* Stats Grid */}
                <View className="flex-row flex-wrap -mx-2">
                    <View className="w-1/2 px-2 mb-4">
                        <Card variant="elevated">
                            <View className="items-center">
                                <View className="w-8 h-8 rounded-full bg-amber-100 items-center justify-center">
                                    <Ionicons name="briefcase" size={16} color="#f59e0b" />
                                </View>
                                <Text className="text-xl font-bold text-amber-500 mt-2">
                                    {stats?.servicios_activos || 0}
                                </Text>
                                <Text className="text-slate-500 text-xs mt-1 text-center">
                                    Servicios Activos
                                </Text>
                            </View>
                        </Card>
                    </View>

                    <View className="w-1/2 px-2 mb-4">
                        <Card variant="elevated">
                            <View className="items-center">
                                <View className="w-8 h-8 rounded-full bg-blue-100 items-center justify-center">
                                    <Ionicons name="school" size={16} color="#3b82f6" />
                                </View>
                                <Text className="text-xl font-bold text-blue-500 mt-2">
                                    {stats?.progreso_promedio?.toFixed(0) || 0}%
                                </Text>
                                <Text className="text-slate-500 text-xs mt-1 text-center">
                                    Progreso Cursos
                                </Text>
                            </View>
                        </Card>
                    </View>

                    <View className="w-1/2 px-2 mb-4">
                        <Card variant="elevated">
                            <View className="items-center">
                                <View className="w-8 h-8 rounded-full bg-red-100 items-center justify-center">
                                    <Ionicons name="alert-circle" size={16} color="#ef4444" />
                                </View>
                                <Text className="text-xl font-bold text-red-500 mt-2">
                                    {stats?.pagos_pendientes || 0}
                                </Text>
                                <Text className="text-slate-500 text-xs mt-1 text-center">
                                    Pagos Pendientes
                                </Text>
                            </View>
                        </Card>
                    </View>

                    <View className="w-1/2 px-2 mb-4">
                        <Card variant="elevated">
                            <View className="items-center">
                                <View className="w-8 h-8 rounded-full bg-green-100 items-center justify-center">
                                    <Ionicons name="cash" size={16} color="#22c55e" />
                                </View>
                                <Text className="text-xl font-bold text-green-500 mt-2">
                                    {stats?.monto_pendiente_formateado || "$0"}
                                </Text>
                                <Text className="text-slate-500 text-xs mt-1 text-center">
                                    Por Pagar
                                </Text>
                            </View>
                        </Card>
                    </View>
                </View>

                {/* Próximos Pagos */}
                <Text className="text-lg font-bold text-slate-800 mb-3 mt-2">Próximos Pagos</Text>

                {proximosPagos.length === 0 ? (
                    <Card variant="outlined">
                        <View className="items-center py-4">
                            <Ionicons name="checkmark-circle" size={40} color="#22c55e" />
                            <Text className="text-slate-500 mt-2">No tienes pagos pendientes</Text>
                        </View>
                    </Card>
                ) : (
                    proximosPagos.map((pago) => (
                        <Card key={pago.id} variant="elevated" className="mb-3">
                            <View className="flex-row items-center justify-between">
                                <View className="flex-1">
                                    <Text className="font-semibold text-slate-800">
                                        {pago.servicio}
                                    </Text>
                                    <Text className="text-slate-500 text-sm">{pago.fecha}</Text>
                                </View>
                                <View className="items-end">
                                    <Text className="font-bold text-slate-800">
                                        {pago.monto_formateado}
                                    </Text>
                                    <Badge
                                        label={pago.vencido ? "Vencido" : "Pendiente"}
                                        variant={pago.vencido ? "error" : "warning"}
                                        size="sm"
                                    />
                                </View>
                            </View>
                        </Card>
                    ))
                )}

                <View className="h-6" />
            </View>
        </ScrollView>
    );
}
