import React, { useEffect, useState } from "react";
import { View, ActivityIndicator, Text } from "react-native";
import { Stack } from "expo-router";
import { StatusBar } from "expo-status-bar";
import { useAuthStore } from "../src/stores/authStore";
import "../global.css";

export default function RootLayout() {
    const { checkAuth, isAuthenticated } = useAuthStore();
    const [isReady, setIsReady] = useState(false);

    useEffect(() => {
        const init = async () => {
            await checkAuth();
            setIsReady(true);
        };
        init();
    }, []);

    if (!isReady) {
        // Usar estilos inline para el loading inicial (antes del contexto de navegación)
        return (
            <View
                style={{
                    flex: 1,
                    alignItems: "center",
                    justifyContent: "center",
                    backgroundColor: "#fff",
                }}
            >
                <ActivityIndicator size="large" color="#f59e0b" />
                <Text style={{ color: "#64748b", marginTop: 16 }}>Iniciando...</Text>
            </View>
        );
    }

    return (
        <>
            <StatusBar style="light" />
            <Stack screenOptions={{ headerShown: false }}>
                {isAuthenticated ? <Stack.Screen name="(tabs)" /> : <Stack.Screen name="(auth)" />}
            </Stack>
        </>
    );
}
