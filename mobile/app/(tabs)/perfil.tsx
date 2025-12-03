import React, { useState } from "react";
import { View, Text, ScrollView, Image, Alert, TextInput, TouchableOpacity } from "react-native";
import { router } from "expo-router";
import { Ionicons } from "@expo/vector-icons";
import { useAuthStore } from "../../src/stores/authStore";
import { Card } from "../../src/components/ui/Card";
import { Button } from "../../src/components/ui/Button";
import { Colors } from "../../src/constants/colors";

export default function PerfilScreen() {
    const { user, logout, updateProfile, isLoading } = useAuthStore();
    const [isEditing, setIsEditing] = useState(false);
    const [nombre, setNombre] = useState(user?.nombre_completo || "");
    const [telefono, setTelefono] = useState(user?.telefono || "");

    const handleLogout = () => {
        Alert.alert("Cerrar Sesión", "¿Estás seguro de que deseas cerrar sesión?", [
            { text: "Cancelar", style: "cancel" },
            {
                text: "Cerrar Sesión",
                style: "destructive",
                onPress: async () => {
                    await logout();
                    router.replace("/(auth)/login");
                },
            },
        ]);
    };

    const handleEdit = () => {
        setNombre(user?.nombre_completo || "");
        setTelefono(user?.telefono || "");
        setIsEditing(true);
    };

    const handleSave = async () => {
        const success = await updateProfile({
            nombre_completo: nombre,
            telefono: telefono,
        });

        if (success) {
            setIsEditing(false);
            Alert.alert("Éxito", "Tu perfil ha sido actualizado.");
        } else {
            Alert.alert("Error", "No se pudo actualizar el perfil.");
        }
    };

    const handleCancel = () => {
        setNombre(user?.nombre_completo || "");
        setTelefono(user?.telefono || "");
        setIsEditing(false);
    };

    return (
        <ScrollView className="flex-1 bg-slate-100">
            {/* Header con foto */}
            <View className="bg-slate-800 px-6 pt-14 pb-12 items-center">
                <View className="w-24 h-24 rounded-full bg-amber-500 items-center justify-center mb-4 overflow-hidden">
                    {user?.foto_perfil ? (
                        <Image
                            source={{ uri: user.foto_perfil }}
                            className="w-full h-full"
                            resizeMode="cover"
                        />
                    ) : (
                        <Text className="text-white text-3xl font-bold">
                            {user?.nombre_completo?.charAt(0) || "U"}
                        </Text>
                    )}
                </View>
                <Text className="text-2xl font-bold text-white">{user?.nombre_completo}</Text>
                <Text className="text-slate-400 mt-1">{user?.email}</Text>
            </View>

            <View className="px-4 -mt-6">
                {/* Info Card */}
                <Card variant="elevated" className="mb-4">
                    <View className="flex-row items-center justify-between mb-4">
                        <Text className="text-lg font-bold text-slate-800">
                            Información Personal
                        </Text>
                        {!isEditing && (
                            <TouchableOpacity onPress={handleEdit} className="p-2">
                                <Ionicons name="pencil" size={20} color={Colors.primary[500]} />
                            </TouchableOpacity>
                        )}
                    </View>

                    {isEditing ? (
                        <>
                            <View className="mb-4">
                                <Text className="text-slate-500 text-xs mb-1">Nombre completo</Text>
                                <TextInput
                                    value={nombre}
                                    onChangeText={setNombre}
                                    className="border border-slate-200 rounded-xl px-4 py-3 text-slate-800"
                                    placeholder="Tu nombre completo"
                                />
                            </View>
                            <View className="mb-4">
                                <Text className="text-slate-500 text-xs mb-1">Teléfono</Text>
                                <TextInput
                                    value={telefono}
                                    onChangeText={setTelefono}
                                    className="border border-slate-200 rounded-xl px-4 py-3 text-slate-800"
                                    placeholder="Tu número de teléfono"
                                    keyboardType="phone-pad"
                                />
                            </View>
                            <View className="flex-row gap-3">
                                <View className="flex-1">
                                    <Button
                                        title="Cancelar"
                                        variant="outline"
                                        onPress={handleCancel}
                                        size="sm"
                                    />
                                </View>
                                <View className="flex-1">
                                    <Button
                                        title="Guardar"
                                        variant="success"
                                        onPress={handleSave}
                                        loading={isLoading}
                                        size="sm"
                                    />
                                </View>
                            </View>
                        </>
                    ) : (
                        <>
                            <View className="flex-row items-center py-3 border-b border-slate-100">
                                <View className="w-10 h-10 bg-amber-100 rounded-full items-center justify-center">
                                    <Ionicons
                                        name="person-outline"
                                        size={20}
                                        color={Colors.primary[500]}
                                    />
                                </View>
                                <View className="ml-3 flex-1">
                                    <Text className="text-slate-500 text-xs">Nombre completo</Text>
                                    <Text className="text-slate-800 font-medium">
                                        {user?.nombre_completo || "-"}
                                    </Text>
                                </View>
                            </View>

                            <View className="flex-row items-center py-3 border-b border-slate-100">
                                <View className="w-10 h-10 bg-blue-100 rounded-full items-center justify-center">
                                    <Ionicons name="mail-outline" size={20} color="#3b82f6" />
                                </View>
                                <View className="ml-3 flex-1">
                                    <Text className="text-slate-500 text-xs">
                                        Correo electrónico
                                    </Text>
                                    <Text className="text-slate-800 font-medium">
                                        {user?.email || "-"}
                                    </Text>
                                </View>
                                {user?.email_verificado && (
                                    <Ionicons name="checkmark-circle" size={20} color="#22c55e" />
                                )}
                            </View>

                            <View className="flex-row items-center py-3 border-b border-slate-100">
                                <View className="w-10 h-10 bg-green-100 rounded-full items-center justify-center">
                                    <Ionicons name="call-outline" size={20} color="#22c55e" />
                                </View>
                                <View className="ml-3 flex-1">
                                    <Text className="text-slate-500 text-xs">Teléfono</Text>
                                    <Text className="text-slate-800 font-medium">
                                        {user?.telefono || "No registrado"}
                                    </Text>
                                </View>
                            </View>

                            <View className="flex-row items-center py-3">
                                <View className="w-10 h-10 bg-purple-100 rounded-full items-center justify-center">
                                    <Ionicons name="shield-outline" size={20} color="#8b5cf6" />
                                </View>
                                <View className="ml-3 flex-1">
                                    <Text className="text-slate-500 text-xs">Rol</Text>
                                    <Text className="text-slate-800 font-medium capitalize">
                                        {user?.rol || "-"}
                                    </Text>
                                </View>
                            </View>
                        </>
                    )}
                </Card>

                {/* App Info */}
                <Card variant="outlined" className="mb-4">
                    <View className="flex-row items-center">
                        <View className="w-12 h-12 bg-amber-500 rounded-xl items-center justify-center">
                            <Text className="text-xl">🚛</Text>
                        </View>
                        <View className="ml-3">
                            <Text className="font-bold text-slate-800">Escuela de Trailers</Text>
                            <Text className="text-slate-500 text-sm">Versión 1.0.0</Text>
                        </View>
                    </View>
                </Card>

                {/* Logout Button */}
                <Button
                    title="Cerrar Sesión"
                    variant="danger"
                    onPress={handleLogout}
                    loading={isLoading}
                    icon={<Ionicons name="log-out-outline" size={20} color="white" />}
                    className="mb-8"
                />
            </View>
        </ScrollView>
    );
}
